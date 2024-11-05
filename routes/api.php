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

Route::get('/user', 'Client\HomeController@getUserWithLevel');
Route::post('/structures/update', 'Portal\StructureController@updateStructure')->name("structures.update");
Route::post('/structures/create', 'Portal\StructureController@createLevel')->name("structures.create");
Route::post('/structures/edit', 'Portal\StructureController@editLevel')->name("structures.edit");
Route::post('/structures/delete', 'Portal\StructureController@deleteLevel')->name("structures.delete");