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
//
//Route::get('/', function () {
//    return view('welcome');
//});


use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login_form');
});
Route::group(['namespace' => 'Web'], function (Router $router) {

    $router->get('login', 'LoginController@login_form')->name('login_form');
    $router->get('logout', 'LoginController@logout')->name('logout');
    $router->post('login', 'LoginController@login')->name('login');

    /**
     * 認証後
     */
    $router->group(['middleware' => ['auth', 'view.api_token']], function (Router $router) {
        $router->get('home', function () {
            return view('day_work');
        })->name('home');

        $router->group(['namespace' => 'User', 'prefix' => 'user', 'as' => 'user.'], function (Router $router) {
            //ユーザー情報照会
            $router->get('info', 'UserController@show')->name('info');

            //ユーザー情報更新

            //API-Token更新

        });

    });
});

