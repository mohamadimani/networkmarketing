<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */

//if (!isset($_SESSION['clerk']['id'])) {
if (!isset($_COOKIE['clerk']) or !isset($_SESSION['clerk']) or $_COOKIE['clerk'] != $_SESSION['clerk']) {
    header("location:" . SITE_URL . "admin_login");
} else {
    class admin_chart extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_more_view_posts = $this->model->get_more_view_posts();
            $get_all_category_posts_count = $this->model->get_all_category_posts_count();
            $all_index_view = $this->model->get_all_views();
            $index_view = $this->model->get_today_views();
            $get_posts_category = $this->model->get_active_posts_category();
            $get_posts_count = $this->model->get_active_posts_count();
            $data = [
                "all_index_view" => $all_index_view,
                "index_view" => $index_view,
                "get_posts_category" => $get_all_category_posts_count["category_count"],
                "active_posts_category" => $get_posts_category,
                "get_posts_count" => $get_all_category_posts_count["posts_count"],
                "active_posts_count" => $get_posts_count,
                "more_view_posts" => $get_more_view_posts,
            ];
            $this->admin_view('admin/admin_chart', $data);
        }


    }
}