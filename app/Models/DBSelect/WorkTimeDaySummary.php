<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/06
 *
 */

namespace App\Models\DBSelect;


use Illuminate\Support\Facades\DB;

class WorkTimeDaySummary {

    static function get($yyyy_mm, $user_id) {
        return DB::select(
            <<<SQL
WITH
    tmp_cal AS (SELECT
                    generate_series((:yyyy_mm || '-01')::timestamp,
                                    DATE_TRUNC('month', (:yyyy_mm || '-01')::date) + '1 month' + '-1 Day', '1 days') AS day
                )
    , calender AS (SELECT
                       day
                       , (ARRAY ['日','月','火','水','木','金','土'])[EXTRACT(DOW FROM CAST(day AS DATE)) + 1] AS week_day
                   FROM
                       tmp_cal
                   )
    , work AS (SELECT
                   calender.*
                   , work_start.user_id
                   , work_start.punch_date_time AS work_start
                   , (SELECT punch_date_time FROM user_work_times AS end_time WHERE punch_type_cd = 2 AND work_start.user_id = end_time.user_id AND work_start.punch_date_time < end_time.punch_date_time ORDER BY end_time.punch_date_time LIMIT 1
                      )                         AS work_end_time
               FROM
                   calender
                       LEFT JOIN user_work_times AS work_start
                                 ON work_start.punch_type_cd = 1 AND to_char(calender.day, 'YYYYMMDD') = to_char(work_start.punch_date_time, 'YYYYMMDD') AND work_start.user_id = :user_id
               )
    , break_times AS (SELECT
                          break_start.punch_date_time AS break_start_time
                          , (SELECT
                                 punch_date_time
                             FROM
                                 user_work_times AS break_end
                             WHERE
                                 punch_type_cd = 4
                                 AND break_start.user_id = break_end.user_id
                                 AND break_start.punch_date_time < break_end.punch_date_time
                             ORDER BY break_end.punch_date_time
                             LIMIT 1
                             )                        AS break_end_time
                      FROM
                          user_work_times AS break_start
                      WHERE
                          user_id = :user_id
                          AND punch_type_cd = 3
                      )
SELECT
    to_char(recored.day, 'MM')                                                                                      AS month
    , to_char(recored.day, 'DD')                                                                                    AS day
    , week_day                                                                                                      AS week_day
    , to_char(work_start, 'HH24:MI')                                                                                AS work_start_time
    , to_char(work_end_time, 'HH24:MI')                                                                             AS work_end_time
    , to_char(break_sum, 'HH24:MI')                                                                                 AS sum_break_time
    , to_char(work_end_time - work_start - coalesce(to_char(break_sum, 'HH24:MI')::time, '00:00'::time), 'HH24:MI') AS day_work_time --秒は切り捨て
FROM
    (
        SELECT *
            , (SELECT sum(break_end_time - break_start_time) FROM break_times WHERE break_times.break_start_time BETWEEN work.work_start AND work.work_end_time) AS break_sum
        FROM
            work
        ) AS recored



SQL

            , ['yyyy_mm' => $yyyy_mm, 'user_id' => $user_id]);
    }
}
