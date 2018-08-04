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

    public function show(Vacancy $vacancy)
    {
        return $vacancy;
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

    public function upgrade($page = 1)
    {

        $apiUrl = "https://api.hh.ru/vacancies/?page=$page";
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);

        $data = json_decode($query);
        if ($data->page < $data->pages || $page > 10) {
            foreach ($data->items as $item) {
                $vacancy = new Vacancy();
                $vacancy->name = $item->name;
                $vacancy->area = $item->area->name;
                $vacancy->url = $item->alternate_url;
                if (isset($item->salary->to)) {
                    $vacancy->salaryTo = $item->salary->to;
                } else{
                    $vacancy->salaryTo = 'NULL';
                }
                if (isset($item->salary->from)) {
                    $vacancy->salaryFrom = $item->salary->from;
                } else {
                    $vacancy->salaryFrom = 'NULL';
                }
                if (isset($item->salary->currency)) {
                    $vacancy->currency = $item->salary->currency;
                } else {
                    $vacancy->currency = 'NULL';
                }
                $vacancy->timestamps = false;
                $vacancy->save();
            }
            return $this->upgrade($page + 1);
        } else {
            return;
        }
    }
}
