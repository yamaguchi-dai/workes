<?php

namespace App\Models;

use App\Models\Core\BaseModel;

class UserWorkTime extends BaseModel {

    const START_TYPE_CD = 1;
    const END_TYPE_CD = 2;

    /**
     * 勤務開始打刻
     * @param $user_id
     * @return mixed
     */
    static function start($user_id) {
        $woker = new UserWorkTime();
        $woker->fill([
            'user_id' => $user_id,
            'punch_date_time' => now(),
            'punch_type_cd' => self::START_TYPE_CD
        ])->save();
        return $woker['id'];
    }

    /**
     * 勤務終了打刻
     * @param $user_id
     * @return mixed
     */
    static function end($user_id) {
        $woker = new UserWorkTime();
        $woker->fill([
            'user_id' => $user_id,
            'punch_date_time' => now(),
            'punch_type_cd' => self::END_TYPE_CD
        ])->save();
        return $woker['id'];
    }
}
