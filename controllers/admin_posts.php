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
    class admin_posts extends controller
    {
        function __construct()
        {
        }

//posts manage view page
        function index()
        {
            $site_posts = $this->model->get_posts();
            $data = [
                'site_posts' => $site_posts
            ];
            $this->admin_view('admin/admin_posts', $data);
        }

        function deleted()
        {
            $site_posts = $this->model->get_posts("delete");
            $data = [
                'site_posts' => $site_posts
            ];
            $this->admin_view('admin/admin_deleted_posts', $data);
        }

        function post_status_change()
        {
            $this->model->post_status_change($_POST["id"], $_POST["status"]);
        }

//add post view page
        function add_post()
        {
            $site_categorys = $this->model->get_categorys();
            $data = [
                'site_categorys' => $site_categorys
            ];
            $this->admin_view('admin/admin_add_post', $data);
        }

//add new post in DB
        function insert_post()
        {
            $this->model->insert_post($_POST, $_FILES);
        }

// =====  update post in DB
        function update_post($post_id = '', $post_category = "")
        {
            $this->model->update_post($_POST, $_FILES, $post_id, $post_category);
        }

        function ajax_upload_img()
        {
            $url = $this->model->ajax_upload_img($_FILES);
            print_r($url);
        }

        function edit_post($post_id = '')
        {
            $site_post = $this->model->get_post($post_id);
            $site_categorys = $this->model->get_categorys();
            $data = [
                'site_post' => $site_post, 'site_categorys' => $site_categorys
            ];
            $this->admin_view('admin/admin_edit_post', $data);
        }
    }
}



