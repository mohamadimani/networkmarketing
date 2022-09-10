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
    class admin_password_change extends controller
    {
        function __construct()
        {

        }

        function index()
        {
            $data = [];
            $this->admin_view('admin/admin_password_change', $data);
        }

        function save_password()
        {
            $this->model->save_password($_POST);
        }

    }
}