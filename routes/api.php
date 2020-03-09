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

Route::group(['namespace' => 'Api', 'middleware' => 'auth.api', 'as' => 'api.'], function (Router $router) {
    $router->group([], function (Router $apiRouter) {
        $apiRouter->group(['prefix' => 'work'], function (Router $router) {
            //勤務開始打刻
            $router->post('start', 'WorkStartController@store')->name('work_start');
            //勤務終了打刻
            $router->post('end', 'WorkEndController@store')->name('work_end');
        });
        $apiRouter->group(['prefix' => 'break'], function (Router $router) {
            //勤務開始打刻
            $router->post('start', 'BreakStartController@store')->name('break_start');
            //勤務終了打刻
            $router->post('end', 'BreakEndController@store')->name('break_end');
        });


        $apiRouter->group(['prefix' => 'report', 'as' => 'report.'], function (Router $router) {
            {
                $router->get('day_summary', 'DaySummaryController@show')->name('day_summary');

                $router->get('all', function () {
                    return App\Models\UserWorkTime::orderBy('id')->get();
                });
            }
        });
    });
});


