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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'work', 'namespace' => 'Api'], function (\Illuminate\Routing\Router $route) {
    //勤務開始打刻
    $route->post('start', 'WorkStartController@store')->name('api_work_start');
    //勤務終了打刻
    $route->post('end', 'WorkEndController@store')->name('api_work_end');
});

