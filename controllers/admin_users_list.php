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
    class admin_users_list extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $users = $this->model->get_users();
            $data = ['users' => $users];
            $this->admin_view('admin/users_list', $data);
        }

        function user_status_change()
        {
            echo $this->model->user_status_change($_POST['id'], $_POST['status']);
        }

        function admin_idea_room()
        {
            $idea_employ = $this->model->admin_idea_room();
            $data = ['idea_employ' => $idea_employ];
            $this->admin_view('admin/admin_idea_employ_list', $data);
        }

        function save_user_status_change()
        {
            $this->model->save_user_status_change($_POST["user_id"]);
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