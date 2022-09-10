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
    class admin_ecomm_product_category extends controller
    {
        function __construct()
        {
        }

        function index($category_id = "")
        {
            $categorys = $this->model->get_categorys_parent($category_id);
            $data = [];
            if (empty($category_id)) {
                $data = ["categorys" => $categorys, "category_id" => $category_id];
            } elseif (!empty($category_id)) {
                $data = ["categorys" => $categorys["childs"], "cat_info" => $categorys["info"], "category_id" => $category_id];
            }
            $this->admin_view('admin/ecomm/category', $data);
        }

        function edit_category($category_id = "")
        {
            $categorys = $this->model->get_all_category($category_id);
            $category_info = $this->model->get_categorys_parent($category_id);
            $data = ["cat_info" => $category_info["info"], "categorys" => $categorys];
            $this->admin_view('admin/ecomm/edit_category', $data);
        }

        function add_category($cat_id = "")
        {
            $this->model->add_category($_POST, $cat_id);
        }

        function category_status_change()
        {
            $this->model->category_status_change($_POST);
        }

        function delete_category()
        {
            $this->model->delete_category($_POST);

        }

        function update_category($cat_id = "")
        {
            $this->model->update_category($_POST, $cat_id);
        }

        function attr($cat_id = "", $attr_id = "")
        {
            $attrs = $this->model->get_attr_parent($cat_id, $attr_id);
            if (empty($attr_id)) {
                $data = ["attrs" => $attrs["attr_parents"], "attr_id" => $attr_id, "cat_id" => $cat_id, "cat_parent" => $attrs["cat_parent"]];
            } else {
                $data = ["attrs" => $attrs["attr_parents"], "attr_info" => $attrs["category_info"], "attr_id" => $attr_id, "cat_id" => $cat_id];
            }
            $this->admin_view('admin/ecomm/category_attr', $data);
        }

        function attr_status_change()
        {
            $this->model->attr_status_change($_POST);
        }

        function delete_attr()
        {
            $this->model->delete_attr($_POST);
        }

        function add_attr($cat_id = "", $attr_id = "")
        {
            $this->model->add_attr($_POST, $cat_id, $attr_id);
        }

        function edit_attr($attr_id = "")
        {
            $attrs = $this->model->get_all_attr($attr_id);
            $data = ["attrs" => $attrs];
            $this->admin_view('admin/ecomm/edit_attr', $data);
        }

        function update_attr($attr_id = "", $parent = "")
        {
            $this->model->update_attr($_POST, $attr_id, $parent);
        }

    }
}

?>

