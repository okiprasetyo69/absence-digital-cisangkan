<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\UserApiController@login');
    Route::post('signup', 'Api\UserApiController@signup');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Api\UserApiController@logout');
        Route::get('user', 'Api\UserApiController@user');
    });
});

//User Module
Route::post('/user', 'Api\UserApiController@createOrUpdate');
Route::get('/user/datatable', 'Api\UserApiController@index');
Route::post('/user/listuser', 'Api\UserApiController@userDatatable');
Route::post('/user/delete/{id}', 'Api\UserApiController@delete');
Route::get('/user/detail/{id}', 'Api\UserApiController@detail');
Route::post('/roles', 'Api\UserApiController@getRoles');
//Absence Module
Route::post('/absence', 'Api\AbsenceApiController@save');
Route::post('/listabsence', 'Api\AbsenceApiController@getListDataAbsence');
Route::post('/absence/export', 'Api\AbsenceApiController@exportExcelAbsence');
Route::post('/absence/absence-filter', 'Api\AbsenceApiController@absencePerDate');
//Topic Module
Route::post('/topic', 'Api\TopicApiController@createOrUpdate');
Route::post('/topic/list-topic', 'Api\TopicApiController@getListDataTopic');
Route::post('/topic/delete/{id}', 'Api\TopicApiController@delete');
Route::get('/topic/detail/{id}', 'Api\TopicApiController@detail');
Route::get('/topic/current-date', 'Api\TopicApiController@getCurrentTopic');
Route::post('/topic/filter-date', 'Api\TopicApiController@getFilterDateTopic');
Route::post('/topic/listtopic-select2', 'Api\TopicApiController@getTopicSelect2');