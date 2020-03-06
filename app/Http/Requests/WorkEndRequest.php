<?php

namespace App\Http\Requests;

use App\Http\Requests\Core\UserWorkTimeRequest;
use App\Models\UserWorkTime;
use Illuminate\Support\Facades\Auth;

class WorkEndRequest extends UserWorkTimeRequest {

    /**
     * @return array
     */
    function setRules(): array {
        return ['api_token' => [function ($attr, $val, $fail) {
            $user_id = Auth::user()['id'];
            if (!UserWorkTime::isWorkEndStatus($user_id)) {
                return $fail('退勤できませんでした。打刻を正しくおこなってください');
            }
        }]];
    }

}
