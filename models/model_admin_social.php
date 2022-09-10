<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_social extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_social($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            return $this->Do_Select("select * from `social` ");
        } else {
            return $this->Do_Select("select * from `social` WHERE `id`=? ", [$id], 1);
        }
    }

    function social_status($id = "", $status = "")
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
            $result = $this->Do_Query("update `social` set `status`=? where `id`=? ", [$status, $id]);
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function insert_social($data = "")
    {
        $name = $this->filter($data["name"]);
        $EN_name = $this->filter($data["EN_name"]);
        $link = $this->filter($data["link"]);
        $icon = $this->filter($data["icon"]);
        $status = $this->filter($data["status"]);

        if ($status == "on") {
            $status = "ACTIVE";
        } elseif ($status != "on") {
            $status = "INACTIVE";
        }


        if (!empty($icon) and !empty($status) and !empty($link) and !empty($EN_name)) {
            $result = $this->Do_Query("insert into `social` (`name`,`EN_name` ,`icon`,`link`,`status`) VALUES (?,?,?,?,?)", [$name, $EN_name, $icon, $link, $status]);
            if ($result == true) {
                $_SESSION["social_save"] = "success";
                header("location:" . SITE_URL . "admin_social");
            } else {
                $_SESSION["social_save"] = "danger";
                header("location:" . SITE_URL . "admin_social");
            }
        } else {
            $_SESSION["social_save"] = "warning";
            header("location:" . SITE_URL . "admin_social");
        }
    }

    function update_social($data = "", $id = "")
    {
        $name = $this->filter($data["name"]);
        $EN_name = $this->filter($data["EN_name"]);
        $link = $this->filter($data["link"]);
        $icon = $this->filter($data["icon"]);
        $status = $this->filter($data["status"]);

//        if ($status == "on") {
//            $status = "ACTIVE";
//        } elseif ($status != "on") {
//        }
        $status = "INACTIVE";


        if (!empty($icon) and !empty($status) and !empty($link) and !empty($EN_name)) {
            $result = $this->Do_Query("update `social` set `name`=? , `EN_name`=? ,`icon`=?,`link`=?,`status`=?  WHERE `id`=?", [$name, $EN_name, $icon, $link, $status, $id]);
            if ($result == true) {
                $_SESSION["social_update"] = "success";
                header("location:" . SITE_URL . "admin_social");
            } else {
                $_SESSION["social_update"] = "danger";
                header("location:" . SITE_URL . "admin_social");
            }
        } else {
            $_SESSION["social_update"] = "warning";
            header("location:" . SITE_URL . "admin_social");
        }
    }

}