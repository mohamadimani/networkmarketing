<?php

/**
 * Created by PhpStorm.
 * User: mani
 * Date: 01/21/2019
 * Time: 11:47 AM
 */

if (!isset($_COOKIE['clerk']) or !isset($_SESSION['clerk']) or $_COOKIE['clerk'] != $_SESSION['clerk']) {
    header("location:" . SITE_URL . "admin_login");
} else {
    class admin_social extends controller
    {


        function __construct()
        {
        }

        function index()
        {
            $get_social = $this->model->get_social();
            $data = ["social" => $get_social];
            $this->admin_view("admin/admin_social", $data);
        }

        function social_status()
        {
            $result = $this->model->social_status($_POST["id"], $_POST["status"]);
            echo $result;
        }

        function insert_social()
        {
            $result = $this->model->insert_social($_POST);
        }

        function edit_social($id = "")
        {
            $get_social = $this->model->get_social($id);
            $data = ["social" => $get_social];
            $this->admin_view("admin/admin_edit_social", $data);
        }

        function update_social($id = "")
        {
            $get_social = $this->model->update_social($_POST,$id);
        }
    }
}
