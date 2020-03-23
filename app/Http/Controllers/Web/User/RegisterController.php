<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/23
 *
 */

namespace App\Http\Controllers\Web\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {

    /**
     * 登録画面取
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index() {
        return view('user.register');
    }

    /**
     * ユーザー登録
     * @param UserRegisterRequest $request
     * @return string
     */
    function registration(UserRegisterRequest $request) {
        (new User())->fill([
            'name' => $request->get('user_name')
            , 'email' => $request->get('email')
            , 'password' => Hash::make($request->get('password'))
        ])->save();


        view_info('登録が完了しました。');
        return redirect(route('login_form'));
    }
}
