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

Route::get('/', function () {
    return view('welcome');
});

Route::get('list', 'FileController@getList');
Route::get('testapi', 'FileController@index');
Route::get('downloadFile/{hashcode}', 'FileController@downloadFile');

Route::post('uploadFile', 'FileController@uploadFile');
Route::post('fetchFile', 'FileController@getFileData');
Route::post('generateFolder', 'FileController@createFolder');
Route::post('renameFile', 'FileController@rename');
