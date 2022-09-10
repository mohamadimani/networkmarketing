<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_panel extends model
{


    function __construct()
    {
        parent::__construct();

    }

//    menu model codes
    function get_menu($id = "")
    {
        if (!empty($id)) {
            $menu = $this->Do_Select("select * from ecomm_menu where `id`=?", [$id], 1);
            return $menu;
        } elseif (empty($id)) {
            $menu = $this->Do_Select("select * from ecomm_menu order by `position` asc ");
            if (!empty($menu)) {
                return $menu;
            } else {
                return [];
            }
        }
    }

    function menu_status($id = "", $status = "")
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
            $result = $this->Do_Query("update `ecomm_menu` set `status`=? where `id`=? ", [$status, $id]);
            if ($result == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function insert_menu($data = "")
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

        if (!empty($status) and !empty($EN_name) and !empty($name)) {
            $result = $this->Do_Query("insert into `ecomm_menu` (`name`,`EN_name` ,`icon`,`link`,`status`) VALUES (?,?,?,?,?)", [$name, $EN_name, $icon, $link, $status]);
            if ($result == true) {
                $_SESSION["menu_save"] = "success";
                header("location:" . SITE_URL . "admin_panel/menu");
            } else {
                $_SESSION["menu_save"] = "danger";
                header("location:" . SITE_URL . "admin_panel/menu");
            }
        } else {
            $_SESSION["menu_save"] = "warning";
            header("location:" . SITE_URL . "admin_panel/menu");
        }
    }

    function update_menu($data = "", $id = "")
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
        if (!empty($icon) and !empty($status) and !empty($link) and !empty($EN_name) and !empty($name)) {
            $result = $this->Do_Query("update `ecomm_menu` set `name`=? , `EN_name`=? ,`icon`=?,`link`=?,`status`=?  WHERE `id`=?", [$name, $EN_name, $icon, $link, $status, $id]);
            if ($result == true) {
                $_SESSION["menu_update"] = "success";
                header("location:" . SITE_URL . "admin_panel/menu");
            } else {
                $_SESSION["menu_update"] = "danger";
                header("location:" . SITE_URL . "admin_panel/menu");
            }
        } else {
            $_SESSION["menu_update"] = "warning";
            header("location:" . SITE_URL . "admin_panel/menu");
        }
    }

    function update_menu_sort($data = "")
    {
        $index = $this->filter($data["index"]);
        $id = $this->filter($data["id"]);
        if (!empty($index) and !empty($id)) {
            $result = $this->Do_Query("update `ecomm_menu` set  `position`=?  WHERE `id`=?", [$index, $id]);
            if ($result == true) {
                echo "1";
            } else {
                echo "0";
            }
        } else {
            echo "0";
        }
    }
//  End   menu model codes

//  news latter
    function get_emails()
    {
        $emails = $this->Do_Select("select * from ecomm_newsletter order by id desc ");
        if (!empty($emails) and is_array($emails)) {
            return $emails;
        } else {
            return [];
        }
    }

    function delete_email($data = [])
    {
        $email_id = $this->filter($data["email_id"]);
        $emails = $this->Do_Query("delete   from ecomm_newsletter where id=? ", [$email_id]);
        if ($emails == true) {
            echo true;
        } else {
            echo false;
        }
    }

    function send_email($data = [])
    {
        $letter = $this->filter($data["letter"]);
        if (!empty($letter)) {
            $emails = $this->Do_Select("select * from ecomm_newsletter  ");
            foreach ($emails as $email) {
			
                mail($email["email"], "فناوری ریزپردازنده فرداهوش", $letter);
            }
            $_SESSION["send_email"] = "success";
            header("location:" . SITE_URL . "admin_panel/news_letter");
        } else {
            $_SESSION["send_email"] = "empty";
            header("location:" . SITE_URL . "admin_panel/news_letter");
        }
    }
//  End news latter

}