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
    class admin_ecomm_orders extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $all_orders = $this->model->get_all_orders();
            $data = ["all_orders" => $all_orders];
            $this->admin_view('admin/ecomm/orders_list', $data);
        }

        function orders_status_change()
        {
            $this->model->orders_status_change($_POST);
        }

        function factor_products_list($factor_id = "")
        {
            $factor_products = $this->model->get_factor_products($factor_id);
            $data = ["factor_products" => $factor_products];
            $this->admin_view("admin/ecomm/factor_products_list", $data);
        }

        function factor_product_status_change()
        {
            $this->model->factor_product_status_change($_POST);
        }

        function set_count()
        {
            $this->model->set_count($_POST);
        }

        function set_discount()
        {
            $this->model->set_discount($_POST);
        }

        function print_factor($factor_id = "")
        {
            $factor_products = $this->model->get_factor_products_print($factor_id);
            $data = ["factor_products" => $factor_products[0], "sum_factor_price" => $factor_products[1], "user_info" => $factor_products[2]];
            $this->admin_view("admin/ecomm/print_factor", $data);
        }

    }
}