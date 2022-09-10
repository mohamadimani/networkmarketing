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
    class admin_access extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $all_access = $this->model->get_all_access();
            $data = ["all_access" => $all_access];
            $this->admin_view('admin/admin_access', $data);
        }

        function edit_access($access_id = "")
        {
            $access = $this->model->get_access($access_id);
            $data = ["access" => $access];
            $this->admin_view('admin/admin_edit_access', $data);
        }

        function access_status_change()
        {
            $result = $this->model->access_status_change($_POST["id"], $_POST["status"]);
            echo $result;
        }

        function update_access($access_id = "")
        {
            $result = $this->model->update_access($_POST, $access_id);
            echo $result;
        }

        function access_delete()
        {
            $result = $this->model->access_delete($_POST["id"]);
            echo $result;
        }

    }
}