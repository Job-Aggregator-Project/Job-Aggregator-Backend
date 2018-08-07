<?php

namespace App\Http\Controllers;

use App\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index(Request $request)
    {
        $vacancies = Vacancy::orderBy('id');
        $searchParametrs = $request->only(['name', 'area']);
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

        return Vacancy::where('originId', $originalId)->first();
    }

    public static function vacancyPicker($item)
    {
        $vacancy = self::inDb($item->id);
        $vacancy = $vacancy ?? new Vacancy();
        $vacancy->originalId = $item->id;
        $vacancy->name = $item->name ?? 'null';
        $vacancy->area = $item->area->name ?? 'null';
        $vacancy->url = $item->alternate_url ?? 'null';
        $vacancy->salaryTo = $item->salary->to ?? 0;
        $vacancy->salaryFrom = $item->salary->from ?? 0;
        $vacancy->currency = $item->salary->currency ?? 'null';
        $vacancy->logo = $item->employer->logo_urls->original ?? 'null';
        $vacancy->employer = $item->employer->name ?? 'null';
        $vacancy->experience = $item->experience->name ?? 'null';
        $vacancy->timestamps = false;
        $vacancy->save();
    }

    public static function overflowCheck()
    {

    }

    static function updateList($page = 0)
    {

        $apiUrl = "https://api.hh.ru/vacancies/?page=$page";
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'jobAgr');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        $data = json_decode($query);
        if (isset($data->page)) {
            foreach ($data->items as $item) {
                self::vacancyPicker($item);
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
