<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/09
 *
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {

    /**
     * ログイン画面描画
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function login_form() {
        return view('login');
    }

    /**
     * ログアウト処理
     * @return \Illuminate\Http\RedirectResponse
     */
    function logout() {
        Auth::logout();
        view_info('ログアウトしました。');
        return redirect()->route('login_form');
    }

    /**
     * ログイン処理
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // 認証に成功した
            return redirect()->route('home');
        }

        return back()->withInput()->withErrors(['認証失敗']);
    }

}
