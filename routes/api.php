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

Route::get('/test', 'ContactsController@test');
Route::get('/contacts', 'ContactsController@fetchAll');
Route::get('/contacts/{id}', 'ContactsController@findOne');
Route::post('/contacts', 'ContactsController@store');
Route::post('/csv/import_parse', 'ImportController@parseImport');
Route::post('/csv/import_process', 'ImportController@processImport');
Route::post('/mapping', 'ImportController@commitMapping');
Route::post('/upload', 'ImportController@fileUpload');
Route::delete('/contacts/{id}', 'ContactsController@delete');
