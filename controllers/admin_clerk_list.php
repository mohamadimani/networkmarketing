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
    class admin_clerk_list extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_clerks = $this->model->get_clerks();
            $data = ['clerks' => $get_clerks];
            $this->admin_view('admin/admin_clerk_list', $data);
        }

        function clerks_access($user_id = "")
        {
            $get_access = $this->model->get_access();
            $get_clerks = $this->model->get_clerks($user_id);
            $data = [
                'clerks' => $get_clerks["user_info"],
                'clerks_access' => $get_clerks["access_info"],
                'access' => $get_access
            ];
            $this->admin_view('admin/admin_clerk_access', $data);
        }

        function user_status_change()
        {
            echo $this->model->user_status_change($_POST['id'], $_POST['status']);
        }

        function user_access_change()
        {
            echo $this->model->user_access_change($_POST);
        }

//       =====  old =====
        function onlines()
        {
            $onlines = $this->model->get_onlines();
            $data = ['onlines' => $onlines];
            $this->admin_view('admin/onlines_list', $data);
        }

        function set_logout_log()
        {
            echo $this->model->set_logout_log($_POST['row_id']);
        }

    }
}