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
    class admin_ecomm_products extends controller
    {
        function __construct()
        {
        }

        function index()
        {
            $all_category = $this->model->get_product_category("parent");
            $all_category_child = $this->model->get_product_category_child();
            $all_product = $this->model->get_products();
            $data = ["categorys" => $all_category, "products" => $all_product, "all_category_child" => $all_category_child];
            $this->admin_view('admin/ecomm/products_list', $data);
        }

        function add_product()
        {
            $all_category = $this->model->get_product_category();
            $all_category_parents = $this->model->get_category_parents();
            $data = ["categorys" => $all_category, "category_parents" => $all_category_parents];
            $this->admin_view('admin/ecomm/add_product', $data);
        }

        function get_category_child_ajax()
        {
            $this->model->get_category_child_ajax($_POST["cat_group"]);
        }

        function add_new_product()
        {
            $this->model->add_new_product($_POST, $_FILES);
        }

        function product_status_change()
        {
            $this->model->product_status_change($_POST);
        }

        function edit_product($producy_id = "")
        {
            $child_category = $this->model->get_category_child();
            $all_category = $this->model->get_category_parents();
            $product = $this->model->get_products($producy_id);
            $data = ["categorys" => $all_category, "product" => $product, "child_category" => $child_category];
            $this->admin_view('admin/ecomm/edit_product', $data);
        }

        function update_product($product_id = "")
        {
            $this->model->update_product($_POST, $product_id);
        }

        function product_gallery($product_id = "")
        {
            $product_images = $this->model->get_product_gallery($product_id);
            $data = ["product_images" => $product_images, "product_id" => $product_id];
            $this->admin_view("admin/ecomm/product_gallery", $data);
        }

        function save_change()
        {
            $this->model->save_change($_POST["name"], $_POST["id"], $_POST["status"]);
        }

        function set_alt()
        {
            $this->model->set_alt($_POST["value"], $_POST["id"]);
        }

        function upload_gallery($product_id = "")
        {
            $this->model->upload_gallery($_FILES, $product_id);
        }

        function delete_img()
        {
            $result = $this->model->delete_img($_POST["id"]);
//            echo $result;
        }

        function product_attr($product_id = "")
        {
            $product_attrs = $this->model->get_product_attrs($product_id);
            $data = ["product_attrs" => $product_attrs[0], "product_info" => $product_attrs[1]];
            $this->admin_view('admin/ecomm/product_attr', $data);
        }

        function add_attr_value()
        {
            $this->model->add_attr_value($_POST);
        }

        function get_ajax_product_cat()
        {
            $this->model->get_ajax_product_cat($_POST);
        }

        function get_ajax_product_child()
        {
            $this->model->get_ajax_product_child($_POST);
        }

        function product_messages()
        {
            $all_messages = $this->model->get_product_messages();
            $data = ["all_messages" => $all_messages];
            $this->admin_view('admin/ecomm/product_messages', $data);
        }

        function set_seen_message()
        {
            $this->model->set_seen_message($_POST);
        }
    }
}