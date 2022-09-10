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
    class admin_audio extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $get_audio_category = $this->model->get_audio_category();
            $audio = $this->model->get_audio();
            $data = [
                'audio' => $audio,
                'get_audio_category' => $get_audio_category,
            ];
            $this->admin_view('admin/audio/admin_audio', $data);
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

        function upload_audio()
        {
            $this->model->upload_audio($_FILES["audio_img"]);
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

//        audio category
        function category()
        {
            $get_category = $this->model->get_category();
            $data = [
                'category' => $get_category
            ];
            $this->admin_view('admin/audio/admin_audio_category', $data);
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
            $this->admin_view('admin/audio/edit_audio_category', $data);
        }

        function update_category_title($id = "")
        {
            $this->model->update_category_title($_POST, $id);

        }

    }
}