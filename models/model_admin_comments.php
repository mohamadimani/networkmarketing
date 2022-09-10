<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_comments extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_comments()
    {
        $site_options = $this->Do_Select("select * from  comments order by `status` ASC ", []);
        $site_options2 = [];
        foreach ($site_options as $option) {
            $date = strtotime($option["date"]);
            date_default_timezone_set("Asia/tehran");
            $year = date('Y', $date);
            $month = date('m', $date);
            $day = date('d', $date);
            $time = date('h:i:s', $date);
            $perdate = $this->gregorian_to_jalali($year, $month, $day);
            $perdate = $perdate[0] . '/' . $perdate[1] . '/' . $perdate[2];
            $option["time"] = $time;
            $option["date"] = $perdate;
            array_push($site_options2, $option);
        }
        return $site_options2;
    }

    function set_seen_comments($comment_id = '')
    {
        $comment_id = $this->filter($comment_id);
        $site_comments = $this->Do_Query("update comments set status='SEEN' where `id`=?", [$comment_id]);
        print_r($site_comments);
    }

}