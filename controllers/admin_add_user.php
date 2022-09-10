<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
if (!isset($_COOKIE['clerk']) or !isset($_SESSION['clerk']) or $_COOKIE['clerk'] != $_SESSION['clerk']) {
    header("location:" . SITE_URL . "admin_login");
} else {
    class admin_add_user extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $captcha = $this->model->get_captcha();
            $data = ["captcha" => $captcha];
            $this->admin_view('admin/admin_add_clerk', $data);
        }

        function edit_clerk($clerk_id = "")
        {
            $clerk = $this->model->get_clerk($clerk_id);
            $data = ["clerk" => $clerk];
            $this->admin_view('admin/admin_edit_clerk', $data);
        }

        function save_user()
        {
            $this->model->save_user($_POST);
        }

        function update_user($clerk_id = "")
        {
            $this->model->update_user($_POST, $clerk_id);
        }

    }
}