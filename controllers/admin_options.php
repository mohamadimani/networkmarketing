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
    class admin_options extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $site_options = $this->model->get_options();
            $data = [
                'site_options' => $site_options
            ];
            $this->admin_view('admin/admin_options', $data);
        }

        function save_options()
        {
            $this->model->save_options($_POST,$_FILES);
        }

    }
}