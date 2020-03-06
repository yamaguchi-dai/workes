<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/05
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\UserWorkTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkEndController extends Controller {

    /**
     * 終了打刻
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    function store(Request $request) {
        //勤怠打刻
        return UserWorkTime::work_end(Auth::user()['id']);
    }

}
