<?php

namespace App\Http\Requests;

use App\Http\Requests\Core\UserWorkTimeRequest;
use Illuminate\Support\Facades\Log;

class WorkStartRequest extends UserWorkTimeRequest {

    /**
     * @return array
     */
    function setRules(): array {
        return ['api_token' => [function ($attr, $val, $fail) {
            //TODO 再度の打刻が退勤であること
            if (FALSE) {
                Log::error('退勤されていません。退勤をおこなってから打刻してください');
                return $fail('退勤されていません。退勤をおこなってから打刻してください');
            }
        }]];
    }

}
