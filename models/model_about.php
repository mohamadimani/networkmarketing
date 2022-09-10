<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_about extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_about()
    {
        $options = $this->Do_Select("select `posts_category`.`id` as `category_id` , `posts`.* from `posts_category` LEFT JOIN `posts` ON  `posts_category`.`id`=`posts`.`category` WHERE `posts_category`.`EN_name`='about_us'  AND `posts`.`status`='ACTIVE' ", [], 1);
        return $options;
    }

    function get_team_gallery()
    {
        $options = $this->Do_Select("select * from team_gallery  WHERE  `status`='ACTIVE' ", []);
        return $options;
    }

}