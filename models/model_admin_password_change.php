<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_password_change extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function save_password($data = "")
    {

        $clerk_id = $this->filter(base64_decode($_SESSION["clerk_id"]));
        $old_password = $this->filter($data["old_password"]);
        $new_password = $this->filter($data["new_password"]);
        $re_new_password = $this->filter($data["re_new_password"]);

        if ($old_password == $new_password) {
            $_SESSION["change_password"] = "repeat_old_new";
            header("location:" . SITE_URL . "admin_password_change");
        } elseif ($new_password != $re_new_password) {
            $_SESSION["change_password"] = "repeat_new";
            header("location:" . SITE_URL . "admin_password_change");
        } else if ($old_password != $new_password AND $new_password == $re_new_password) {

            if (!empty($old_password) and !empty($new_password) and !empty($re_new_password)) {
                $clerk_info = $this->Do_Select(" select * from  `user` where `id`=?", [$clerk_id], 1);
                $success_old_pass = $this->password_verify($old_password, $clerk_info["password"]);
                if ($success_old_pass == true) {

                    $new_pass = $this->password_hash($new_password);
                    $change_pass_result = $this->Do_Query(" update   `user` set `password`=? where `id`=?", [$new_pass, $clerk_id]);
                    if ($change_pass_result == true) {
                        $_SESSION["change_password"] = "success";
                        header("location:" . SITE_URL . "admin_password_change");
                    } else {
                        $_SESSION["change_password"] = "danger";
                        header("location:" . SITE_URL . "admin_password_change");
                    }
                } else if (empty($success_old_pass) OR $success_old_pass != true) {
                    $_SESSION["change_password"] = "old_pass";
                    header("location:" . SITE_URL . "admin_password_change");
                }
            } else {
                $_SESSION["change_password"] = "empty";
                header("location:" . SITE_URL . "admin_password_change");
            }
        }

    }

}