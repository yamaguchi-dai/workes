<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\UserToken;
use App\Models\UserWorkTime;
use Illuminate\Http\Request;

class BreakStartController extends Controller {
    function store(Request $request) {
        $token = $request->get('token');
        /** @var UserToken $userToken */
        $userToken = UserToken::where('token', $token)->first();
        //Tokenが存在しない場合
        if (!$userToken) throw new \Exception('tokenを確認してください。token:' . $token);
        //勤怠打刻
        return UserWorkTime::break_start($userToken->user()['id']);

    }

}
