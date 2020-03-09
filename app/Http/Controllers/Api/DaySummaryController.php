<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/09
 *
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\UserWorkTime;
use Illuminate\Support\Facades\Auth;

class DaySummaryController extends Controller {
    function show() {
        return UserWorkTime::getDaysSummary(Auth::id());
    }

}
