<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $vacancies = Vacancy::orderBy('id');
        $searchParametrs = $request->only(['name', 'area', 'description']);
        if (!empty($searchParametrs)) {
            foreach ($searchParametrs as $column => $value) {
                $vacancies->where($column, 'like', "%$value%");
            }
        }
        return $vacancies->paginate(20);
    }

    public function showAll()
    {
        return Vacancy::all();
    }

    public function show(Vacancy $vacancy)
    {
        return $vacancy;
    }

    public static function inDb($originalId)
    {

        return Vacancy::where('originalId', $originalId)->first();
    }

    public static function takeSingleVacancy($id)
    {
        $apiUrl = "https://api.hh.ru/vacancies/$id";
        $vacancy = self::vacancyRequest($apiUrl);
        if (isset($vacancy->id)) {
            self::vacancyPicker($vacancy);
        }
    }

    public static function vacancyPicker($item)
    {
        $vacancy = self::inDb($item->id);
        $vacancy = $vacancy ?? new Vacancy();
        $vacancy->originalId = $item->id;
        $vacancy->name = $item->name ?? '';
        $vacancy->experience = $item->experience->name ?? '';
        $vacancy->description = $item->description ?? '';
        $vacancy->area = $item->area->name ?? '';
        $vacancy->url = $item->alternate_url ?? '';
        $vacancy->salaryTo = $item->salary->to ?? 0;
        $vacancy->salaryFrom = $item->salary->from ?? 0;
        $vacancy->currency = $item->salary->currency ?? '';
        $vacancy->logo = $item->employer->logo_urls->original ?? '';
        $vacancy->employer = $item->employer->name ?? '';
        $vacancy->timestamps = false;
        $vacancy->save();
    }

    public static function overflowCheck()
    {

    }

    public static function vacancyRequest($apiUrl)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'jobAgr');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        return json_decode($query);
    }

    static function updateList($page = 0)
    {

        $apiUrl = "https://api.hh.ru/vacancies/?page=$page";

        $data = self::vacancyRequest($apiUrl);
        if (isset($data->page)) {
            foreach ($data->items as $item) {
                if (isset($item->id)) {
                    self::takeSingleVacancy($item->id);
                }
            }
            return self::updateList($page + 1);
        } else {
            return;
        }
    }

//    public function store(Request $request)
//    {
//        $vacancy = Vacancy::create($request->all());
//
//        return response()->json($vacancy, 201);
//    }

//    public function update(Request $request, Vacancy $vacancy)
//    {
//        $vacancy->update($request->all());
//
//        return response()->json($vacancy, 200);
//    }

//    public function delete(Vacancy $vacancy)
//    {
//        $vacancy->delete();
//
//        return response()->json(null, 204);
//    }
}
