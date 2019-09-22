<?php

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

Route::get('/', function () {return redirect('login');});
Route::get('/home', function () {return redirect('Arena');});

Auth::routes();

Route::get('/Arena', 'HomeController@index')->name('home');
Route::post('/Arena', 'HomeController@teenAdd')->name('teen.add');//TODO
Route::get('/Atividades', 'HomeController@activities')->name('activity');
Route::post('/Atividades', 'HomeController@activitiesAdd')->name('activity.add');
Route::get('/Lideres', 'HomeController@leaders')->name('leader');
Route::post('/Lideres', 'HomeController@leadersAdd')->name('leader.add');
Route::get('/Chamada', 'HomeController@calling')->name('calling');//TODO
Route::post('/Chamada', 'HomeController@callingAdd')->name('calling.add');//TODO
