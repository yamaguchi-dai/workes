<?php

namespace App\Models;

use App\Models\Core\BaseModel;

class UserWorkTime extends BaseModel {

    const WORK_START_TYPE_CD = 1;
    const WORK_END_TYPE_CD = 2;
    const BREAK_START_TYPE_CD = 3;
    const BREAK_END_TYPE_CD = 4;

    /**
     * 勤務開始打刻
     * @param $user_id
     * @return mixed
     */
    static function work_start($user_id) {
        return self::register($user_id, self::WORK_START_TYPE_CD);
    }

    /**
     * 勤務終了打刻
     * @param $user_id
     * @return mixed
     */
    static function work_end($user_id) {
        return self::register($user_id, self::WORK_END_TYPE_CD);
    }

    /**
     * 休憩開始打刻
     * @param $user_id
     * @return mixed
     */
    static function break_start($user_id) {
        return self::register($user_id, self::BREAK_START_TYPE_CD);
    }

    /**
     * 休憩終了打刻
     * @param $user_id
     * @return mixed
     */
    static function break_end($user_id) {
        return self::register($user_id, self::BREAK_END_TYPE_CD);
    }

    /**
     * 登録処理
     * @param $user_id
     * @param $punch_type_cd
     * @return mixed
     */
    private static function register($user_id, $punch_type_cd) {
        $woker = new UserWorkTime();
        $woker->fill([
            'user_id' => $user_id,
            'punch_date_time' => now(),
            'punch_type_cd' => $punch_type_cd
        ])->save();
        return $woker['id'];
    }
}
