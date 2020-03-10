<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/09
 *
 */

namespace App\Http\Controllers\Web\User;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    function show() {
        return view('user.user_info', ['user' => Auth::user()]);
    }
}
