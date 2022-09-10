<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_login extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function set_logout_log($type = '')
    {
//        $this->Do_Query("update `onlines` set `online`='off' WHERE `type`=? and `session`=? ", [$type, $_SESSION['clerk']]);
    }

    function check_clerk_login($username = '', $password = '')
    {
        $username = $this->filter($username);
        $password = $this->filter($password);
        if (!empty($username) and !empty($password)) {
            $user_info = $this->Do_Select(" select * from `user` where username=? ", [$username], 1);
            if (!empty($user_info)) {
                if ($user_info["status"] == "ACTIVE") {
                    if ($this->password_verify($password, $user_info['password'])) {
                        $last_login = $this->time_to_jalali_date('DT');
                        $this->Do_Query('update `user` set last_login=? where id=?', [$last_login['date'] . ' - ' . $last_login['time'], $user_info['id']]);
                        $str_cod = $this->str_cod(20);
                        $_SESSION['clerk_id'] = base64_encode($user_info['id']);
                        $_SESSION['clerk'] = $str_cod;
                        setcookie("clerk", $str_cod, time() + 4000, "/"); // 1000 = 16:30 min
                        $_SESSION["admin_login_time"] = time() + 4000;
//                    $onlines_info = $this->Do_Select(" select * from `onlines` where `type`='clerk' and `user_id`=? and `online`='on'", [$user_info['id']]);
//                    if (empty($onlines_info)) {
//                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['clerk', $user_info['id'], $user_info['name'] . ' ' . $user_info['family'], $user_info['username'], $this->ip(), time(), $str_cod]);
//                    } else if (!empty($onlines_info)) {
//                        $this->Do_Query("update `onlines` set `online`='off' WHERE  `type`='clerk' and `user_id`=? and `online`='on' ", [$user_info['id']]);
//                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['clerk', $user_info['id'], $user_info['name'] . ' ' . $user_info['family'], $user_info['username'], $this->ip(), time(), $str_cod]);
//                    }
                        return true;
                    } else {
                        return false;
                    }
                } elseif ($user_info["status"] == "INACTIVE") {
                    return "inactive";
                }
            } else {
                return false;
            }
        }
    }


}