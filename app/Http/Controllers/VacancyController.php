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
