<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\BreakEndRequest;
use App\Models\UserWorkTime;
use Illuminate\Support\Facades\Auth;

class BreakEndController extends Controller {
    function store(BreakEndRequest $request) {
        //勤怠打刻
        return UserWorkTime::break_end(Auth::user()['id']);

    }

}
