<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::namespace('APi')->group(function (Router $ApiRoute) {
    $ApiRoute->group(['prefix' => 'work'], function (Router $router) {
        //勤務開始打刻
        $router->post('start', 'WorkStartController@store')->name('api_work_start');
        //勤務終了打刻
        $router->post('end', 'WorkEndController@store')->name('api_work_end');
    });
    $ApiRoute->group(['prefix' => 'break'], function (Router $router) {
        //勤務開始打刻
        $router->post('start', 'BreakStartController@store')->name('api_break_start');
        //勤務終了打刻
        $router->post('end', 'BreakEndController@store')->name('api_break_end');
    });
});


