<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
class ecomm extends controller
{
    function __construct()
    {
    }

    function index()
    {
        $new_products = $this->model->get_new_products();
        $top_sell_products = $this->model->get_top_sell_products();
        $top_view_products = $this->model->get_top_view_products();
        $data = ["new_products" => $new_products, "top_sell_products" => $top_sell_products, "top_view_products" => $top_view_products];
        $this->ecomm_view('index', $data);
    }

    function set_like()
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            echo "login";
        } else {
            $this->model->set_like($_POST);
        }
    }

    function add_favorit()
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            echo "login";
        } else {
            $this->model->add_favorit($_POST["product_id"]);
        }
    }

    function newsletter()
    {
        $this->model->newsletter($_POST);
    }

//  product
    function product($product_id = "")
    {
        $product_attr = $this->model->get_product_attr($product_id);
        $product_gallery = $this->model->get_product_gallery($product_id);
        $product_info = $this->model->get_product_info($product_id);
        $product_message = $this->model->get_product_message($product_id);
        $data = ["product_info" => $product_info, "product_message" => $product_message, "product_id" => $product_id, "product_gallery" => $product_gallery, "product_attr" => $product_attr];
        $this->ecomm_view('product', $data);
    }

    function save_message($product_id = "")
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            header("location:" . SITE_URL . "users/user_login");
        } else {
            $this->model->save_message($_POST, $product_id);
        }
    }

    function add_basket()
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            $_SESSION["product_before_login"] = $_POST["product_id"];
//            header("location:" . SITE_URL . "users/user_login");
//            print_r($_SESSION["product_before_login"]);
            echo "login";
        } else {
            $this->model->add_basket($_POST);
        }
    }

    function basket()
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            header("location:" . SITE_URL . "users/user_login");
        } else {
            $basket_info = $this->model->get_basket();
            $data = ["basket_info" => $basket_info];
            $this->ecomm_view('basket', $data);
        }
    }

    function remode_basket_item($product_id = "")
    {
        $this->model->remode_basket_item($product_id);
    }

    function checkout($factor_id = "")
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            header("location:" . SITE_URL . "users/user_login");
        } else {
            $this->model->checkout($factor_id);
        }
    }

    function pay_veryfy()
    {
        if (!isset($_COOKIE['user']) or !isset($_SESSION['user']) or $_COOKIE['user'] != $_SESSION['user']) {
            header("location:" . SITE_URL . "users/user_login");
        } else {
            if (isset($_GET['Authority'])) {
                $result = $this->model->pay_veryfy($_GET['Authority'], $_GET['Status']);
                header('location:' . SITE_URL . 'users/orders');
            } else {
                header('location:' . SITE_URL . 'ecomm/basket');
            }
        }
    }

    function products($cat_id = "")
    {
        $products = $this->model->products($cat_id);
        $data = ["products" => $products];
        $this->ecomm_view("products", $data);
    }

    function get_cat_childeren()
    {
        $this->model->get_cat_childeren($_POST);
    }

    function seen_product()
    {
        $this->model->seen_product($_POST["product_id"]);
    }

    function law()
    {
        if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) {
            $law = $this->model->get_law();
            $user_info = $this->model->user_info();
            $data = ["law" => $law, "user_info" => $user_info];
            $this->ecomm_view('law', $data);
        } else {
            header("location:" . SITE_URL . "users/user_login");
        }
    }
}
