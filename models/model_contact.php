<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_contact extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_contact()
    {
        return $this->get_options();
    }

    function save_conmment($data = "")
    {
        $name = $this->filter($data["name"]);
        $phone = $this->filter($data["phone"]);
        $email = $this->filter($data["email"]);
        $content = $this->filter($data["comment"]);
        if (!empty($name) and !empty($phone) and !empty($content)) {

            $result = $this->Do_Query("insert into `comments` (`name`,`email`,`comment`,`phone`) VALUES (?,?,?,?)", [$name, $email, $content, $phone]);
            if ($result == true) {
                $_SESSION["send_message"] = "success";
                header("location:" . SITE_URL . "contact");
            } else {
                $_SESSION["send_message"] = "danger";
                header("location:" . SITE_URL . "contact");
            }
        } else {
            $_SESSION["send_message"] = "empty";
            header("location:" . SITE_URL . "contact");
        }
    }


}