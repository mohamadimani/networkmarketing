<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
class users extends controller
{
    function __construct()
    {
    }

    function index()
    {
        if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) {
            $user_info = $this->model->get_user_info();
            $data = ["user_info" => $user_info];
            $this->user_view('index', $data);
        } else {
            header("location:" . SITE_URL . "users/user_login");
        }
    }

    function user_login()
    {
        if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) {
            header("location:" . SITE_URL . "ecomm");
        } else {
            $data = [];
            $this->ecomm_view('login', $data);
        }
    }

    function check_user_login()
    {
        $this->model->check_user_login($_POST);
    }

    function user_logout()
    {
        //        $this->model->set_logout_log('clerk');
        unset($_SESSION["user_id"]);
        unset($_SESSION["user"]);
        setcookie("user", '', time() + 1, "/");
        header("location:" . SITE_URL . "ecomm");
    }

    function user_register()
    {
        $this->model->user_register($_POST);
    }

    function update_user_info()
    {
        $this->model->update_user_info($_POST);
    }

    function orders()
    {
        if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) {
            $orders = $this->model->get_orders();
            $data = ["orders" => $orders];
            $this->user_view("orders", $data);
        } else {
            header("location:" . SITE_URL . "users/user_login");
        }
    }

    function favorites()
    {
        if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) {
            $favorites = $this->model->get_favorites();
            $data = ["favorites" => $favorites];
            $this->user_view("favorites", $data);
        } else {
            header("location:" . SITE_URL . "users/user_login");
        }
    }

}
