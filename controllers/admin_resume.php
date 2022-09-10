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
    class admin_resume extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $resume = $this->model->get_resume();
            $data = ["resume" => $resume
            ];
            $this->admin_view('admin/admin_resume', $data);
        }

        function single_resume($id = "")
        {
            $resume = $this->model->get_resume($id);
            $data = ["resume" => $resume
            ];
            $this->admin_view('admin/admin_single_resume', $data);
        }

        function update_resume_status()
        {
            $this->model->update_resume_status($_POST["resume_id"]);
        }

    }
}