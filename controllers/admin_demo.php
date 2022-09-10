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
    class admin_demo extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_demo_sub_category = $this->model->get_demo_category();
            $data = [
                'demo_sub_category' => $get_demo_sub_category,
            ];
            $this->admin_view('admin/demo/category_items', $data);
        }

        function category($category_id = "")
        {
            $get_demo_category = $this->model->get_demo_category($category_id);
            $get_category_info = $this->model->get_category_info($category_id);
            $data = [
                "category_info" => $get_category_info,
                "category_id" => $category_id,
                'demo_category' => $get_demo_category,
            ];
            $this->admin_view('admin/demo/category', $data);
        }

        function add_category($cat_id = "")
        {
            $this->model->add_category($_POST, $cat_id);
        }

        function category_status_change()
        {
            $this->model->category_status_change($_POST);
        }

        function delete_category()
        {
            $this->model->delete_category($_POST);

        }

        function update_category($cat_id = "")
        {
            $this->model->update_category($_POST, $cat_id);
        }

        function edit_category($category_id = "")
        {
            $get_demo_category = $this->model->get_all_category($category_id);
            $get_category_info = $this->model->get_category_info($category_id);
            $data = [
                "category_info" => $get_category_info,
                "category_id" => $category_id,
                'demo_category' => $get_demo_category,
            ];
            $this->admin_view('admin/demo/edit_category', $data);
        }

        function gallery($category_id = "")
        {
            $get_demo_gallery = $this->model->get_demo_gallery($category_id);
            $get_demo_category = $this->model->get_demo_category($category_id);
            $data = [
                'demo_gallery' => $get_demo_gallery,
                'demo_category' => $get_demo_category,
                'category_id' => $category_id,
            ];
            $this->admin_view('admin/demo/demo_gallery', $data);
        }

// old
        function save_change()
        {
            $this->model->save_change($_POST["name"], $_POST["id"], $_POST["status"]);
        }

        function set_link()
        {
            $this->model->set_link($_POST["value"], $_POST["id"]);
        }

        function set_alt()
        {
            $this->model->set_alt($_POST["value"], $_POST["id"]);
        }

        function upload_demo($category_id = "")
        {
            $this->model->upload_demo($_FILES["demo_img"], $category_id);
        }

        function delete_img()
        {
            $result = $this->model->delete_img($_POST["id"]);
            print_r($result);
        }

        function update_demo_category()
        {
            $this->model->update_demo_category($_POST["cat_id"], $_POST["img_id"]);
        }

    }
}