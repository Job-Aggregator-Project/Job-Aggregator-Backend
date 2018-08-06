<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('vacancies', 'VacancyController@index');
Route::get('vacancies/all','VacancyController@showAll');
Route::get('vacancies/{vacancy}', 'VacancyController@show');
Route::post('vacancies', 'VacancyController@store');
Route::put('vacancies/{vacancy}', 'VacancyController@update');
Route::delete('vacancies/{vacancy}', 'VacancyController@delete');
