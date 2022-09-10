<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_gallery_category extends model
{

    function __construct()
    {
        parent::__construct();
    }


    function get_category($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $categorys = $this->Do_Select("select * from `gallery_category`  order by `id` desc ", []);
            return $categorys;
        } elseif (!empty($id) and is_numeric($id)) {
            $categorys = $this->Do_Select("select * from `gallery_category`  WHERE `id`=?   order by `id` desc ", [$id], 1);
            return $categorys;
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
            $result = $this->Do_Query("update `gallery_category` set `status`=? where `id`=? ", [$status, $id]);
            return true;
        } else {
            return false;
        }
    }

    function category_delete($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $post_count = $this->Do_Select(" select `id` from `gallery` where `category`=? ", [$id], 1);
            if ($post_count["id"] > 0) {
                echo "posts";
            } else if ($post_count["title"] == 0) {
                $result = $this->Do_Query("delete   from `gallery_category` where `id`=? ", [$id]);
                return true;
            }
        } else {
            return false;
        }
    }

    function save_category($data = "")
    {
        $name = $this->filter($data["title"]);

        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }


        if (!empty($name)) {
            $categorys = $this->Do_Query(" insert into   `gallery_category` (`title`, `status`)  VALUES (?,?) ", [$name, $status]);
            if ($categorys == true) {
                $_SESSION["save_category"] = "success";
                header("location:" . SITE_URL . "admin_gallery_category");
            } else {
                $_SESSION["save_category"] = "danger";
                header("location:" . SITE_URL . "admin_gallery_category");
            }
        } else {
            $_SESSION["save_category"] = "empty";
            header("location:" . SITE_URL . "admin_gallery_category");
        }

    }

    function update_category($data = "", $id = "")
    {
        $name = $this->filter($data["name"]);
        $id = $this->filter($id);
        if (!empty($name) and !empty($id)) {
            $result = $this->Do_Query("update `gallery_category` set `title`=? where `id`=? ", [$name, $id]);
            if ($result == true) {
                $_SESSION["edit_gallery_category"] = "success";
                header("location:" . SITE_URL . "admin_gallery_category");
            } else {
                $_SESSION["edit_gallery_category"] = "danger";
                header("location:" . SITE_URL . "admin_gallery_category/edit_category/" . $id);
            }
        } else {
            $_SESSION["edit_gallery_category"] = "empty";
            header("location:" . SITE_URL . "admin_gallery_category/edit_category/" . $id);
        }
    }


}