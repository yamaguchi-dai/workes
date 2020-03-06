<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/06
 *
 */

namespace App\Models\DBSelect;


use Illuminate\Support\Facades\DB;

class WorkTimeDaySummary {

    static function get() {
        return DB::select(
            <<<SQL
WITH
    work AS (
        SELECT
            id
            , user_id
            , punch_date_time                                                                                                                                                                  AS work_start_time
            , (SELECT punch_date_time FROM user_work_times AS end_time WHERE punch_type_cd = 2 AND start.punch_date_time < end_time.punch_date_time ORDER BY end_time.punch_date_time LIMIT 1) AS work_end_time
        FROM
            user_work_times AS start
        WHERE
            punch_type_cd = 1
        ORDER BY id
        )
    , break AS (
    SELECT
        id
        , user_id
        , punch_date_time                                                                                                                                                                  AS break_start
        , (SELECT punch_date_time FROM user_work_times AS end_time WHERE punch_type_cd = 4 AND start.punch_date_time < end_time.punch_date_time ORDER BY end_time.punch_date_time LIMIT 1) AS break_end
    FROM
        user_work_times AS start
    WHERE
        punch_type_cd = 3
    )
SELECT
    to_char(work_start_time, 'MM')                                                                                            AS month
    , to_char(work_start_time, 'd')                                                                                           AS day
    , (ARRAY ['日','月','火','水','木','金','土'])[EXTRACT(DOW FROM CAST(work_start_time AS DATE)) + 1]                              AS week_day
    , to_char(work_start_time, 'HH24:MI')                                                                                     AS work_start_time
    , to_char(work_end_time, 'HH24:MI')                                                                                       AS work_end_time
    , to_char(sum_break_time, 'HH24:MI')                                                                                      AS sum_break_time
    , to_char(work_end_time - work_start_time - coalesce(to_char(sum_break_time, 'HH24:MI')::time, '00:00'::time), 'HH24:MI') AS day_work_time --秒は切り捨て
FROM
    (
        SELECT *
            , (SELECT SUM(b.break_end - b.break_start) FROM break AS b WHERE w.user_id = b.user_id AND b.break_start BETWEEN w.work_start_time AND w.work_end_time) AS sum_break_time
        FROM
            work AS w
        ) AS records
SQL

        );
    }
}
