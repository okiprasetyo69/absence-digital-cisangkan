<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function()
{
    return View('absence_homepage');
});
//Route::get('/', 'HomeController@index');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['role:superadmin']], function () {
    Route::get('/superadmin', 'HomeController@IndexSuperAdmin')->name('superadmin');
    Route::get('/usersettings', 'SuperAdminController@userSettings')->name('usersettings');
    Route::get('/absence', 'SuperAdminController@absence')->name('absence');
    Route::get('/topics', 'SuperAdminController@topics')->name('topics');
    Route::get('/absence/export_excel/{absence_date_val}', 'SuperAdminController@exportAbsences');
    Route::get('/absence/export_to_excel', 'SuperAdminController@exportAbsencesToExcel');
    //Route::get('/absence/report', 'SuperAdminController@getAbsenceReport')->name('absence_report');
    Route::get('/absence/export-pdf/{absence_date}','SuperAdminController@exportPDFAbsence');
    Route::get('/absence/export-pdf/{event_date}','SuperAdminController@getAbsenceReport');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', 'HomeController@IndexAdmin')->name('admin');
});

Route::group(['middleware' => ['role:spv_man_admin']], function () {
    Route::get('/spv', 'HomeController@IndexSpvManAdmin')->name('spv');
});

Route::group(['middleware' => ['role:head']], function () {
    Route::get('/head', 'HomeController@IndexHead')->name('head');
});

Route::group(['middleware' => ['role:employee']], function () {
    Route::get('/employee', 'HomeController@IndexEmployee')->name('employee');
});

Route::group(['middleware' => ['role:security']], function () {
    Route::get('/security', 'HomeController@IndexSecurity')->name('security');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/user', 'HomeController@userView')->name('user');
});
