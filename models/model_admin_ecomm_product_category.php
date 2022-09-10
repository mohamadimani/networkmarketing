<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_ecomm_product_category extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_categorys_parent($category_id = "")
    {
        $category_id = $this->filter($category_id);
        if (empty($category_id)) {
            $result = $this->Do_Select("select * from ecomm_product_category WHERE `parent`='0' ORDER by `id` DESC ");
            return $result;
        } else {
            $category_childs = $this->Do_Select("select * from ecomm_product_category WHERE `parent`=? ORDER by `id` DESC ", [$category_id]);
            $category_info = $this->Do_Select("select * from ecomm_product_category WHERE `id`=?", [$category_id], 1);
            return ["info" => $category_info, "childs" => $category_childs];
        }
    }

    function get_all_category($category_id = "")
    {
        $result1 = $this->Do_Select("select `cat_group` from ecomm_product_category   WHERE `id`=?", [$category_id], 1);
//        $category_childs = $this->Do_Select("select * from ecomm_product_category WHERE `parent`=? ORDER by `id` DESC ", [$category_id]);
        $result = $this->Do_Select("select * from ecomm_product_category WHERE cat_group NOT IN (?)  ORDER by `id` DESC ", [$result1["cat_group"]]);
        return $result;
    }

    function add_category($data = "", $cat_id = "")
    {
        $cat_id = $this->filter($cat_id);
        $title = $this->filter($data["name"]);
        $status1 = $this->filter($data["status"]);

        if ($status1 == "on") {
            $status = "ACTIVE";
        } elseif (empty($status1)) {
            $status = "INACTIVE";
        }

        if (!empty($title) and !empty($status)) {
            $cat_result = $this->Do_Query("insert into  ecomm_product_category (`title`,`status`,`parent`) VALUES (?,?,?)", [$title, $status, $cat_id]);
            $last_id = $this->conn->lastInsertId();
            if ($cat_result) {
                if ($cat_id == 0) {
                    $cat_result = $this->Do_Query("update    ecomm_product_category set  cat_group=? where `id`=? ", [$last_id, $last_id]);
                } else {
                    $result = $this->Do_Select("select `cat_group` from ecomm_product_category   WHERE `id`=?", [$cat_id], 1);
                    $cat_result = $this->Do_Query("update    ecomm_product_category set  cat_group=? where `id`=? ", [$result["cat_group"], $last_id]);
                }
                $_SESSION["add_product_category"] = "success";
            } else {
                $_SESSION["add_product_category"] = "danger";
            }
        } else {
            $_SESSION["add_product_category"] = "empty";
        }
        header("location:" . SITE_URL . "admin_ecomm_product_category/index/" . $cat_id);
    }

    function category_status_change($data = "")
    {
        $category_id = $this->filter($data["id"]);
        $category_status = $this->filter($data["status"]);
        if ($category_status == "active") {
            $category_status = "ACTIVE";
        } elseif ($category_status == "inactive") {
            $category_status = "INACTIVE";
        }
        if (!empty($category_status) and !empty($category_id)) {
            $result = $this->Do_Query("update ecomm_product_category set `status`=? WHERE `id`=?", [$category_status, $category_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function delete_category($data = "")
    {
        $category_id = $this->filter($data["id"]);
        if (!empty($category_id)) {
            $is_child = $this->Do_Select("select * from ecomm_product_category WHERE `parent`=? ", [$category_id]);
            $is_product = $this->Do_Select("select * from ecomm_products WHERE `category`=? ", [$category_id]);
            if (empty($is_child) and empty($is_product)) {
                $result = $this->Do_Query("delete from ecomm_product_category WHERE `id`=? ", [$category_id]);
                $result1 = $this->Do_Query("delete from ecomm_category_attr WHERE `category_id`=? ", [$category_id]);
                if ($result == true) {
                    echo true;
                } else {
                    echo false;
                }
            } elseif (!empty($is_child) or !empty($is_product)) {
                echo 2;
            }
        }
    }

    function update_category($data = "", $cat_id = "")
    {
        $parent = $this->filter($data["parent"]);
        $name = $this->filter($data["name"]);
        $status = $this->filter($data["status"]);
        $cat_id = $this->filter($cat_id);
        if ($status == "on") {
            $status = "ACTIVE";
        } else {
            $status = "INACTIVE";
        }
        if (!empty($status) and !empty($name) and !empty($cat_id)) {
            $result = $this->Do_Query("update ecomm_product_category set `title`=? , `parent`=? , `status`=? where `id`=? ", [$name, $parent, $status, $cat_id]);
            if ($result == true) {

                $result = $this->Do_Select("select `cat_group` from ecomm_product_category   WHERE `id`=?", [$parent], 1);
                $cat_result = $this->Do_Query("update    ecomm_product_category set  cat_group=? where `id`=? ", [$result["cat_group"], $cat_id]);

                $_SESSION["edit_product_category"] = "success";
                header("location:" . SITE_URL . "admin_ecomm_product_category/index/" . $parent);
            } else {
                $_SESSION["edit_product_category"] = "warning";
                header("location:" . SITE_URL . "admin_ecomm_product_category/edit_category/" . $cat_id);
            }
        } else {
            $_SESSION["edit_product_category"] = "empty";
            header("location:" . SITE_URL . "admin_ecomm_product_category/edit_category/" . $cat_id);
        }

    }

    function get_attr_parent($category_id = "", $attr_id = "")
    {
        if (empty($attr_id)) {
            $category_childs = $this->Do_Select("select * from ecomm_category_attr WHERE `category_id`=? and parent='0' ORDER by `id` DESC ", [$category_id]);
            $cat_parent = $this->Do_Select("select `parent` from  ecomm_product_category WHERE `id`=?     ", [$category_id], 1);
            return ["attr_parents" => $category_childs, "cat_parent" => $cat_parent["parent"]];
        } else if (empty($attr_id) or $category_id == "0") {
            $category_childs = $this->Do_Select("select * from ecomm_category_attr WHERE `parent`=?  ORDER by `id` DESC ", [$attr_id]);
            $category_info = $this->Do_Select("select * from ecomm_category_attr WHERE `id`=?  ORDER by `id` DESC ", [$attr_id], 1);
            return ["attr_parents" => $category_childs, "category_info" => $category_info];
        }
    }

    function attr_status_change($data = "")
    {
        $category_id = $this->filter($data["id"]);
        $category_status = $this->filter($data["status"]);
        if ($category_status == "active") {
            $category_status = "ACTIVE";
        } elseif ($category_status == "inactive") {
            $category_status = "INACTIVE";
        }
        if (!empty($category_status) and !empty($category_id)) {
            $result = $this->Do_Query("update ecomm_category_attr set `status`=? WHERE `id`=?", [$category_status, $category_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function delete_attr($data = "")
    {
        $category_id = $this->filter($data["id"]);
        if (!empty($category_id)) {
            $is_child = $this->Do_Select("select * from ecomm_category_attr WHERE `parent`=? ", [$category_id]);
//            $is_product = $this->Do_Select("select * from ecomm_product_attr WHERE `attr_id`=? ", [$category_id]);
            if (empty($is_child)) {
                $result1 = $this->Do_Query("delete from ecomm_category_attr WHERE `id`=? ", [$category_id]);
                $result = $this->Do_Query("delete from ecomm_product_attr WHERE `attr_id`=? ", [$category_id]);
                if ($result1 == true) {
                    echo true;
                } else {
                    echo false;
                }
            } elseif (!empty($is_child) or !empty($is_product)) {
                echo 2;
            }
        }


    }

    function add_attr($data = "", $cat_id = "", $attr_id = "")
    {
        $attr_id = $this->filter($attr_id);
        $cat_id = $this->filter($cat_id);
        $title = $this->filter($data["name"]);
        $status1 = $this->filter($data["status"]);
        if ($status1 == "on") {
            $status = "ACTIVE";
        } elseif (empty($status1)) {
            $status = "INACTIVE";
        }

        if (!empty($title) and !empty($status)) {
            $cat_result = $this->Do_Query("insert into  ecomm_category_attr (`title`,`status`,`parent`,`category_id`) VALUES (?,?,?,?)", [$title, $status, $attr_id, $cat_id]);
            if ($cat_result) {
                $_SESSION["add_category_attr"] = "success";
            } else {
                $_SESSION["add_category_attr"] = "danger";
            }
        } else {
            $_SESSION["add_category_attr"] = "empty";
        }
        if ($attr_id == 0) {
            header("location:" . SITE_URL . "admin_ecomm_product_category/attr/" . $cat_id);
        } else {
            header("location:" . SITE_URL . "admin_ecomm_product_category/attr/0/" . $attr_id);
        }
    }

    function get_all_attr($attr_id = "")
    {
        $result1 = $this->Do_Select("select `cat_group` from ecomm_category_attr   WHERE `id`=?", [$attr_id], 1);
        $category_childs = $this->Do_Select("select * from ecomm_product_category WHERE `parent`=? ORDER by `id` DESC ", [$attr_id]);
        $result = $this->Do_Select("SELECT * FROM `ecomm_category_attr` WHERE  `id`=? ", [$attr_id], 1);
        return $result;
    }

    function update_attr($data = "", $attr_id = "", $parent = "")
    {
//        $parent = $this->filter($data["parent"]);
        $name = $this->filter($data["name"]);
        $status = $this->filter($data["status"]);
        $attr_id = $this->filter($attr_id);
        if ($status == "on") {
            $status = "ACTIVE";
        } else {
            $status = "INACTIVE";
        }
        if (!empty($status) and !empty($name) and !empty($attr_id)) {
            $result = $this->Do_Query("update ecomm_category_attr set `title`=?  , `status`=? where `id`=? ", [$name, $status, $attr_id]);
            $info = $this->Do_Select("select * from ecomm_category_attr  where `id`=? ", [$attr_id], 1);
            if ($result == true) {
                $_SESSION["edit_category_attr"] = "success";
                if ($info["parent"] == 0) {
                    header("location:" . SITE_URL . "admin_ecomm_product_category/attr/" . $info["category_id"]);
                } else {
                    header("location:" . SITE_URL . "admin_ecomm_product_category/attr/0/" . $info["parent"]);
                }
            } else {
                $_SESSION["edit_category_attr"] = "warning";
                header("location:" . SITE_URL . "admin_ecomm_product_category/edit_attr/" . $attr_id);
            }
        } else {
            $_SESSION["edit_category_attr"] = "empty";
            header("location:" . SITE_URL . "admin_ecomm_product_category/edit_attr/" . $attr_id);
        }

    }
}