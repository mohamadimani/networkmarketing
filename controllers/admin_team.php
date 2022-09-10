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
    class admin_team extends controller
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
            $this->admin_view('admin/team/admin_team', $data);
        }

        function user_name()
        {
            $this->model->user_name($_POST["value"], $_POST["id"]);
        }

        function occupation()
        {
            $this->model->occupation($_POST["value"], $_POST["id"]);
        }

        function status()
        {
            $this->model->status($_POST["name"], $_POST["id"], $_POST["status"]);
        }

//old

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