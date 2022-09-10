<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_single extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_blog($post_id = '')
    {
        $post_id = $this->filter($post_id);
        $options = $this->Do_Select("select  * from   `posts`    WHERE  `id`=?   AND  `status`='ACTIVE' ", [$post_id], 1);
        $options["creat_date"] = $this->convert_date($options["creat_date"]);
        return $options;
    }

    function seen_post($post_id = "")
    {
        $post_id = $this->filter($post_id);
        $this->Do_Query("update `posts` set `view_count`=`view_count`+1 WHERE `id`=?", [$post_id]);
    }


}