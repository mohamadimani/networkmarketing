<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_access extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_all_access()
    {
        $result = $this->Do_select("select * from access_list");
        return $result;
    }

    function get_access($access_id = "")
    {
        $result = $this->Do_select("select * from access_list WHERE `id`=?", [$access_id], 1);
        return $result;
    }

    function access_status_change($id = "", $status = "")
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
            $result = $this->Do_select("select `EN_name` from `access_list` WHERE `id`=?", [$id], 1);
            $result = $this->Do_Query("delete   from `user_access` where `access`=? ", [$result["EN_name"]]);
            $result = $this->Do_Query("update `access_list` set `status`=? where `id`=? ", [$status, $id]);
            return true;
        } else {
            return false;
        }
    }

    function update_access($data = "", $id = "")
    {
        $id = $this->filter($id);
        $name = $this->filter($data["title"]);
        $EN_name = $this->filter($data["EN_name"]);
        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }

        if (empty($id)) {
            if (!empty($name) and !empty($EN_name)) {
                $file = "controllers/" . $EN_name . ".php";
                if (file_exists($file) == true) {
                    $is_categorys = $this->Do_Select(" select * from  `access_list` where `EN_name`=?", [$EN_name], 1);
                    if (empty($is_categorys)) {
                        $categorys = $this->Do_Query(" insert into `access_list`(`title`,`EN_name`,`status`) VALUES (?,?,?)", [$name, $EN_name, $status]);
                        if ($categorys == true) {
                            $_SESSION["add_access"] = "success";
                        } else {
                            $_SESSION["add_access"] = "danger";
                        }
                    } elseif (!empty($is_categorys)) {
                        $_SESSION["add_access"] = "repeat";
                    }
                } else {
                    $_SESSION["add_access"] = "is_not_file";
                }
            } else {
                $_SESSION["add_access"] = "empty";
            }
            header("location:" . SITE_URL . "admin_access");

        } elseif (!empty($id)) {
            if (!empty($name) and !empty($EN_name)) {
                $file = "controllers/" . $EN_name . ".php";
                if (file_exists($file) == true) {
                    $is_categorys = $this->Do_Select(" select `id` from  `access_list` where `EN_name`=?", [$EN_name], 1);
                    if (empty($is_categorys["id"]) or $is_categorys["id"] == $id) {
                        $categorys = $this->Do_Query(" update   `access_list` set `title`=?,`EN_name`=?,`status`=? where `id`=?", [$name, $EN_name, $status, $id]);
                        if ($categorys == true) {
                            $_SESSION["edit_access"] = "success";
                            header("location:" . SITE_URL . "admin_access");
                        } else {
                            $_SESSION["edit_access"] = "danger";
                            header("location:" . SITE_URL . "admin_access/edit_access/" . $id);
                        }
                    } elseif (!empty($is_categorys["id"]) and $is_categorys["id"] != $id) {
                        $_SESSION["edit_access"] = "repeat";
                        header("location:" . SITE_URL . "admin_access/edit_access/" . $id);
                    }
                } else {
                    $_SESSION["edit_access"] = "is_not_file";
                    header("location:" . SITE_URL . "admin_access/edit_access/" . $id);
                }
            } else {
                $_SESSION["edit_access"] = "empty";
                header("location:" . SITE_URL . "admin_access/edit_access/" . $id);
            }
        }

    }

    function access_delete($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $result = $this->Do_select("select `EN_name` from `access_list` WHERE `id`=?", [$id], 1);
            $result = $this->Do_Query("delete   from `user_access` where `access`=? ", [$result["EN_name"]]);
            $result = $this->Do_Query("delete   from `access_list` where `id`=? ", [$id]);
            return true;
        } else {
            return false;
        }
    }
}