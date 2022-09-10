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
    class admin_gallery_category extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_category = $this->model->get_category();
            $data = [
                'category' => $get_category
            ];
            $this->admin_view('admin/admin_gallery_category', $data);
        }

        function category_status_change()
        {
            $result = $this->model->category_status_change($_POST["id"], $_POST["status"]);
            print_r($result);
        }

        function category_delete()
        {
            $result = $this->model->category_delete($_POST["id"]);
            print_r($result);
        }

        function save_category()
        {
            $this->model->save_category($_POST);
        }

        function edit_category($id = "")
        {
            $get_category = $this->model->get_category($id);
            $data = [
                'category' => $get_category
            ];
            $this->admin_view('admin/edit_gallery_category', $data);
        }

        function update_category($id = "")
        {
            $this->model->update_category($_POST,$id);

        }

    }
}