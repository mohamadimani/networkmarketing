<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_add_user extends model
{

    function get_clerk($clerk_id = "")
    {
        $clerk_id = $this->filter($clerk_id);
        return $this->Do_Select("select * from `user` where `id`=? ", [$clerk_id], 1);
    }

    function __construct()
    {
        parent::__construct();
    }

    function get_captcha()
    {
        $captcha = $this->captcha_cod();
        $captcha_question = $captcha["question"];
        $_SESSION["captcha_answer"] = $captcha["answer"];
        return $captcha_question;
    }

    function save_user($data = "")
    {
        $name = $this->filter($data["name"]);
        $mobile = $this->filter($data["mobile"]);
        $user_name = $this->filter($data["username"]);
        $password = $this->filter($data["password"]);
        $re_password = $this->filter($data["re_password"]);
        $captcha = $this->filter($data["captcha"]);
        if (empty($password) or $password != $re_password) {
            $_SESSION["add_clerk"] = "re_pass";
            header("location:" . SITE_URL . "admin_add_user");
        } else {
            $password_hash = $this->password_hash($password);
            if (empty($captcha) or trim($captcha) != trim($_SESSION["captcha_answer"])) {
                $_SESSION["add_clerk"] = "captcha";
                header("location:" . SITE_URL . "admin_add_user");
            } else {
                if (!empty($name) and !empty($mobile) and !empty($user_name)) {
                    $is_clerk = $this->Do_Select("select * from `user` WHERE `username`=? ", [$user_name], 1);
                    if (empty($is_clerk['id'])) {
                        $insert_result = $this->Do_Query("insert into `user` (`name`,`username`,`password`,`mobile`) VALUES (?,?,?,?)", [$name, $user_name, $password_hash, $mobile]);
                        if ($insert_result == true) {
                            $_SESSION["add_clerk"] = "success";
                            header("location:" . SITE_URL . "admin_clerk_list");
                        } else {
                            $_SESSION["add_clerk"] = "danger";
                            header("location:" . SITE_URL . "admin_add_user");
                        }
                    } else {

                        $_SESSION["add_clerk"] = "is_clerk";
                        header("location:" . SITE_URL . "admin_add_user");
                    }
                } else {
                    $_SESSION["add_clerk"] = "empty";
                    header("location:" . SITE_URL . "admin_add_user");
                }
            }
        }
    }

    function update_user($data = "", $clerk_id = "")
    {
        $clerk_id = $this->filter($clerk_id);
        $name = $this->filter($data["name"]);
        $mobile = $this->filter($data["mobile"]);
        $user_name = $this->filter($data["username"]);

        if (!empty($name) and !empty($mobile) and !empty($user_name)) {
            $is_clerk = $this->Do_Select("select `id` from `user` WHERE `username`=? ", [$user_name], 1);

            if (empty($is_clerk['id']) or $is_clerk['id'] == $clerk_id) {
                $insert_result = $this->Do_Query("update    `user` set  `name`=? ,`username`=?,`mobile`=?  where `id`=? ", [$name, $user_name, $mobile, $clerk_id]);
                if ($insert_result == true) {
                    $_SESSION["update_clerk"] = "success";
                    header("location:" . SITE_URL . "admin_clerk_list");
                } else {
                    $_SESSION["update_clerk"] = "danger";
                    header("location:" . SITE_URL . "admin_add_user/edit_clerk/" . $clerk_id);
                }
            } else {
                $_SESSION["update_clerk"] = "is_clerk";
                header("location:" . SITE_URL . "admin_add_user/edit_clerk/" . $clerk_id);
            }
        } else {
            $_SESSION["update_clerk"] = "empty";
            header("location:" . SITE_URL . "admin_add_user/edit_clerk/" . $clerk_id);
        }
    }


}