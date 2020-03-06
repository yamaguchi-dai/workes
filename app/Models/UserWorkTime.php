<?php

namespace App\Models;

use App\Models\Core\BaseModel;
use Illuminate\Support\Facades\Log;

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
        Log::info('打刻　TYPE:' . $woker['punch_type_cd'] . ' TIME:' . $woker['punch_date_time'] . ' USER_ID:' . $woker['user_id']);
        return $woker['id'];
    }

    /**
     * 最終打刻情報を取得
     * @param $user_id
     * @return mixed
     */
    static function getLastPunch($user_id) {
        $work_timer = UserWorkTime::where('user_id', $user_id)->orderBy('punch_date_time', 'desc')->first();
        Log::debug('前回打刻情報 user_id:' . $user_id . ' UserWorkTimeID:' . $work_timer['id']);
        return $work_timer['punch_type_cd'];
    }


    /**
     * 出勤可能であるか
     * @param $user_id
     * @return bool TRUE:出勤可能
     */
    static function isWorkStartStatus($user_id): bool {
        return self::getLastPunch($user_id) === self::WORK_END_TYPE_CD;
    }

    /**
     * 退勤可能であるか
     * @param $user_id
     * @return bool
     */
    static function isWorkEndStatus($user_id): bool {
        $lastPunchTypeCd = self::getLastPunch($user_id);
        //最終打刻が出勤OR休憩終了であること
        return $lastPunchTypeCd === self::WORK_START_TYPE_CD || $lastPunchTypeCd === self::BREAK_END_TYPE_CD;
    }

    /**
     * 休憩入可能であるか
     * @param $user_id
     * @return bool
     */
    static function isBreakStartStatus($user_id): bool {
        $lastPunchTypeCd = self::getLastPunch($user_id);
        //最終打刻が出勤、もしくは休憩出であること
        return $lastPunchTypeCd === self::WORK_START_TYPE_CD || $lastPunchTypeCd === self::BREAK_END_TYPE_CD;
    }

    /**
     * 休憩出可能であるか
     * @param $user_id
     * @return bool
     */
    static function isBreadEndStatus($user_id): bool {
        $lastPunchTypeCd = self::getLastPunch($user_id);
        //最終打刻が休入であること
        return $lastPunchTypeCd === self::BREAK_START_TYPE_CD;
    }
}
