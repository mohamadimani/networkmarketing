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
    class admin_projects extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_projects = $this->model->get_projects();
            $data = [
                'projects' => $get_projects
            ];
            $this->admin_view('admin/projects/index', $data);
        }

        function save_project()
        {
            $this->model->save_project($_POST);
        }

        function project_status_change()
        {
            $result = $this->model->project_status_change($_POST["id"], $_POST["status"]);
        }

//        function category_delete()
//        {
//            $result = $this->model->category_delete($_POST["id"]);
//            print_r($result);
//        }


        function edit_project($id = "")
        {
            $get_projects = $this->model->get_projects($id);
            $data = [
                'projects' => $get_projects
            ];
            $this->admin_view('admin/projects/edit_project', $data);
        }

        function update_project($id = "")
        {
            $this->model->update_project($_POST, $id);

        }

    }
}