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
    class admin_comments extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $site_comments = $this->model->get_comments();
            $data = [
                'site_comments' => $site_comments
            ];
            $this->admin_view('admin/admin_comments', $data);
        }

        function set_seen_comments()
        {
            $this->model->set_seen_comments($_POST["comment_id"]);
        }
    }
}