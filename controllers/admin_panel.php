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
    class admin_panel extends controller
    {
        function __construct()
        {
        }

//    menu control codes
        function index()
        {
            $data = [];
            $this->admin_view('admin/admin_panel', $data);
        }

        function menu()
        {
            $menu = $this->model->get_menu();
            $data = ["menu" => $menu];
            $this->admin_view('admin/menu/admin_menu', $data);
        }

        function menu_status()
        {
            $result = $this->model->menu_status($_POST["id"], $_POST["status"]);
            echo $result;
        }

        function insert_menu()
        {
            $result = $this->model->insert_menu($_POST);
        }

        function edit_menu($id = "")
        {
            $get_menu = $this->model->get_menu($id);
            $data = ["menu" => $get_menu];
            $this->admin_view("admin/menu/admin_edit_menu", $data);
        }

        function update_menu($id = "")
        {
            $get_menu = $this->model->update_menu($_POST, $id);
        }

        function update_menu_sort()
        {
            $get_menu = $this->model->update_menu_sort($_POST);
        }
//    End menu control codes

//    news latter
        function news_letter()
        {
            $emails = $this->model->get_emails();
            $data = ["emails" => $emails];
            $this->admin_view('admin/news_latter/admin_news_latter', $data);
        }

        function delete_email()
        {
            $emails = $this->model->delete_email($_POST);
        }

        function send_email()
        {
            $emails = $this->model->send_email($_POST);
        }
//    ENd news latter

    }
}