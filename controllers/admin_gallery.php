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
    class admin_gallery extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_gallery_category = $this->model->get_gallery_category();
            $gallery = $this->model->get_gallery();
            $data = [
                'gallery' => $gallery,
                'get_gallery_category' => $get_gallery_category,
            ];
            $this->admin_view('admin/admin_gallery', $data);
        }

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

        function upload_gallery()
        {
            $this->model->upload_gallery($_FILES["gallery_img"]);
        }

        function delete_img()
        {
            $result = $this->model->delete_img($_POST["id"]);
            print_r($result);
        }

        function update_category()
        {
            $this->model->update_category($_POST["cat_id"], $_POST["img_id"]);
        }

    }
}