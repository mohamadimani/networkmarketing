<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_category extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_category($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $categorys = $this->Do_Select("select * from `posts_category`  order by `id` desc ", []);
            return $categorys;
        } else if (!empty($id)) {
            $categorys = $this->Do_Select("select * from `posts_category` WHERE `id`=? ", [$id], 1);
            return $categorys;
        }
    }

    function save_category($data = "", $id = "")
    {

        $id = $this->filter($id);
        $name = $this->filter($data["name"]);
        $EN_name = $this->filter($data["EN_name"]);
        $post_count = $this->filter($data["post_count"]);


        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($post_count) or !is_numeric($post_count)) {
            $post_count = 20;
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }
        if (empty($id)) {
            if (!empty($name) and !empty($EN_name)) {
                $is_categorys = $this->Do_Select(" select * from  `posts_category` where `EN_name`=?", [$EN_name], 1);
                if (empty($is_categorys)) {
                    $categorys = $this->Do_Query(" insert into `posts_category`(`name`,`EN_name`,`post_count`,`status`) VALUES (?,?,?,?)", [$name, $EN_name, $post_count, $status]);
                    if ($categorys == true) {
                        $_SESSION["add_category"] = "success";
                    } else {
                        $_SESSION["add_category"] = "danger";
                    }
                } elseif (!empty($is_categorys)) {
                    $_SESSION["add_category"] = "warning";
                }
            } else {
                $_SESSION["add_category"] = "empty";
            }
            header("location:" . SITE_URL . "admin_category");

        } elseif (!empty($id)) {
            if (!empty($name) and !empty($EN_name)) {
                $is_categorys = $this->Do_Select(" select `id` from  `posts_category` where `EN_name`=?", [$EN_name], 1);
                if (empty($is_categorys["id"]) or $is_categorys["id"] == $id) {
                    $categorys = $this->Do_Query(" update   `posts_category` set `name`=?,`EN_name`=?,`post_count`=?,`status`=? where `id`=?", [$name, $EN_name, $post_count, $status, $id]);
                    if ($categorys == true) {
                        $_SESSION["edit_category"] = "success";
                        header("location:" . SITE_URL . "admin_category");
                    } else {
                        $_SESSION["edit_category"] = "danger";
                        header("location:" . SITE_URL . "admin_category/edit_category/" . $id);
                    }
                } elseif (!empty($is_categorys["id"]) and $is_categorys["id"] != $id) {
                    $_SESSION["edit_category"] = "warning";
                    header("location:" . SITE_URL . "admin_category/edit_category/" . $id);
                }
            } else {
                $_SESSION["edit_category"] = "empty";
                header("location:" . SITE_URL . "admin_category/edit_category/" . $id);
            }
        }
    }

    function category_status_change($id = "", $status = "")
    {

        $id = $this->filter($id);
        $status = $this->filter($status);
        if ($status == "active") {
            $status = "ACTIVE";
        }
        if ($status == "inactive") {
            $status = "INACTIVE";
        }

        if (!empty($id) and !empty($status)) {
            $result = $this->Do_Query("update `posts_category` set `status`=? where `id`=? ", [$status, $id]);
            return true;
        } else {
            return false;
        }
    }

    function category_delete($id = "")
    {

        $id = $this->filter($id);

        if (!empty($id)) {
            $post_count = $this->Do_Select("select `posts` from `posts_category` where `id`=?", [$id], 1);
            if ($post_count["posts"] > 0) {
                echo "posts";
            } else if ($post_count["posts"] == 0) {
                $result = $this->Do_Query("delete   from `posts_category` where `id`=? ", [$id]);
                return true;
            }
        } else {
            return false;
        }
    }

}