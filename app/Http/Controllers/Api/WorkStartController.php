<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\WorkStartRequest;
use App\Models\UserWorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkStartController extends Controller {

    /**
     * 勤怠打刻
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    function store(WorkStartRequest $request) {
        //勤怠打刻
        return UserWorkTime::work_start(Auth::user()['id']);
    }
}
