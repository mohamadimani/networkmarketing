<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
class admin_login extends controller
{
    function __construct()
    {
    }

    function index()
    {
        if (isset($_COOKIE['clerk']) and isset($_SESSION['clerk']) and $_COOKIE['clerk'] == $_SESSION['clerk']) {
            header("location:" . SITE_URL . "admin_panel");
        } else {
            $data = [];
            $this->admin_view('admin/admin_login', $data);
        }
    }

    function logout()
    {
//        $this->model->set_logout_log('clerk');
        unset($_SESSION['clerk']);
        unset($_SESSION["admin_login_time"]);
//        unset($_SESSION['clerk_id']);

        setcookie("clerk", '', time() + 1, "/");
        header("location:" . SITE_URL . "admin_login");
    }

    function check_clerk_login()
    {
        echo $this->model->check_clerk_login($_POST['username'], $_POST['password']);
    }


}
