<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_chart extends model
{


    function __construct()
    {
        parent::__construct();

    }

    function get_more_view_posts()
    {
        $count = $this->Do_Select("SELECT posts.`id`,posts.`title`, posts.`category`,posts.`view_count` ,posts_category.`name` as category  FROM  posts LEFT JOIN posts_category ON posts.category=posts_category.id WHERE posts.view_count >0  ORDER by posts.view_count DESC limit 0,5 ", []);
        return $count;
    }

    function get_today_views()
    {

        $count = $this->Do_Select("SELECT count(id) as `today_views` , sum(`views`) as `all_today_views`  FROM `page_views_log`  where `page_name`='index' and `view_date`>=? ", [strtotime('today midnight')], 1);
        if (empty($count["today_views"])) {
            $count["today_views"] = 0;
        }
        if (empty($count["all_today_views"])) {
            $count["all_today_views"] = 0;
        }
        return $count;
    }

    function get_all_views()
    {
        $count = $this->Do_Select("SELECT count(id) as `views_count` , sum(`views`) as `all_views_count` FROM `page_views_log`  where `page_name`='index' ", [], 1);
        if (empty($count["views_count"])) {
            $count["views_count"] = 0;
        }
        if (empty($count["all_views_count"])) {
            $count["all_views_count"] = 0;
        }
        return $count;
    }

    function get_active_posts_category()
    {
        $count = $this->Do_Select("SELECT count(id) as `category_count` FROM `posts_category` WHERE status='ACTIVE' ", [], 1);
        if (empty($count["category_count"])) {
            $count["category_count"] = 0;
        }
        return $count["category_count"];
    }

    function get_active_posts_count()
    {
        $count = $this->Do_Select("SELECT count(id) as `posts_count`    FROM `posts`  WHERE status='ACTIVE' ", [], 1);
        if (empty($count["posts_count"])) {
            $count["posts_count"] = 0;
        }
        return $count["posts_count"];
    }

    function get_all_category_posts_count()
    {
        $count = $this->Do_Select("SELECT posts_category.id as category_count  , posts.id as posts_count  FROM   posts_category left join posts on posts_category.id=posts.category ", []);
        foreach ($count as $row) {
            $category_count[] = $row["category_count"];
            $posts_count[] = $row["posts_count"];
        }
        $category_count = count(array_filter(array_unique($category_count)));
        $posts_count = count(array_filter(array_unique($posts_count)));

        return ["category_count" => $category_count, "posts_count" => $posts_count];
    }

}