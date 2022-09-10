<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_user_panel extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_user_ip()
    {
        if (!empty($this->ip())) {
            return $this->ip();
        }

    }

    function get_user()
    {
        $user_id = $this->filter(base64_decode($_SESSION['user_id']));
        if (!empty($user_id)) {
            $user_info = $this->Do_Select('select * from `users` where id=?', [$user_id], 1);
            if (!empty($user_info)) {
                return $user_info;
            }
        }
    }

    function update_user($user_info = '')
    {
        $name = $this->filter($user_info['name']);
        $family = $this->filter($user_info['family']);
        $address = $this->filter($user_info['address']);
        $sex = $this->filter($user_info['sex']);
        $tel = $this->filter($user_info['tel']);

        if (!empty($name) and !empty($family) and !empty($address) and !empty($sex) and !empty($tel)) {
            $update_result = $this->Do_Query('update  users set `name`=?,`family`=?,`tel`=?,`address`=?,`sex`=? WHERE `id`=?', [$name, $family, $tel, $address, $sex, base64_decode($_SESSION['user_id'])]);
            if ($update_result == true) {
                $_SESSION['user_sex'] = $sex;
                return true;
            }
        }
    }

}