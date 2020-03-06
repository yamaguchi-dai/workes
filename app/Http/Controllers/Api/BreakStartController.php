<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\BreakStartRequest;
use App\Models\UserWorkTime;
use Illuminate\Support\Facades\Auth;

class BreakStartController extends Controller {
    function store(BreakStartRequest $request) {

        //勤怠打刻
        return UserWorkTime::break_start(Auth::user()['id']);

    }

}
