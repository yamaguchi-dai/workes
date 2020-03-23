<?php
/**
 * Created by dai.yamaguchi
 * DATE: 2020/03/23
 *
 */

if (!function_exists('view_info')) {
    function view_info($msg) {
        session()->flash('info_msg', $msg);
    }
}


