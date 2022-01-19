<?php

use App\Http\Controllers\CountryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries/list', [CountryController::class, 'list'])->middleware('auth:sanctum');
Route::get('/countries/selected', [CountryController::class, 'selectedCountries'])->middleware('auth:sanctum');
Route::post('/countries/add-selected', [CountryController::class, 'addSelectedCountry'])->middleware('auth:sanctum');
Route::post('/countries/delete-selected-country',[CountryController::class, 'deleteSelectedCountry'])->middleware('auth:sanctum'); 