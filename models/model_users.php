<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_users extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_user_info()
    {
        $user_id = $this->filter(base64_decode($_SESSION['user_id']));
        return $this->Do_Select("select * from `users` where `id`=?", [$user_id], 1);
    }

    function check_user_login($data = [])
    {
        $username = $this->filter($data["username"]);
        $password = $this->filter($data["password"]);
        if (!empty($username) and !empty($password)) {
            $user_info = $this->Do_Select(" select * from `users` where username=? ", [$username], 1);
            if (!empty($user_info)) {
                if ($user_info["status"] == "ACTIVE") {
                    if ($this->password_verify($password, $user_info['password'])) {
                        $last_login = $this->time_to_jalali_date('DT');
                        $this->Do_Query('update `users` set last_login=? where id=?', [$last_login['date'] . ' - ' . $last_login['time'], $user_info['id']]);
                        $str_cod = $this->str_cod(20);
                        $_SESSION['user_id'] = base64_encode($user_info['id']);
                        $_SESSION['user'] = $str_cod;
                        setcookie("user", $str_cod, time() + 4000, "/"); // 1000 = 16:30 min
                        $_SESSION["user_login_time"] = time() + 4000;
//                    $onlines_info = $this->Do_Select(" select * from `onlines` where `type`='clerk' and `user_id`=? and `online`='on'", [$user_info['id']]);
//                    if (empty($onlines_info)) {
//                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['clerk', $user_info['id'], $user_info['name'] . ' ' . $user_info['family'], $user_info['username'], $this->ip(), time(), $str_cod]);
//                    } else if (!empty($onlines_info)) {
//                        $this->Do_Query("update `onlines` set `online`='off' WHERE  `type`='clerk' and `user_id`=? and `online`='on' ", [$user_info['id']]);
//                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['clerk', $user_info['id'], $user_info['name'] . ' ' . $user_info['family'], $user_info['username'], $this->ip(), time(), $str_cod]);
//                    }
                        $_SESSION["user_login"] = "success";
                        if (isset($_SESSION["product_before_login"]) and !empty($_SESSION["product_before_login"])) {
                            $this->add_basket($_SESSION["product_before_login"]);
                            unset($_SESSION["product_before_login"]);
                            header("location:" . SITE_URL . "ecomm/basket");
                        } else {
                            header("location:" . SITE_URL . "ecomm");
                        }
                    } else {
                        $_SESSION["user_login"] = "password";
                        header("location:" . SITE_URL . "users/user_login");
                    }
                } elseif ($user_info["status"] == "INACTIVE") {
                    $_SESSION["user_login"] = "inactive";
                    header("location:" . SITE_URL . "users/user_login");
                }
            } else {
                $_SESSION["user_login"] = "username";
                header("location:" . SITE_URL . "users/user_login");
            }
        } else {
            $_SESSION["user_login"] = "empty";
            header("location:" . SITE_URL . "users/user_login");
        }

    }

    function user_register($data = [])
    {
        $mobile = $this->filter($data["mobile"]);
        $user_name = $this->filter($data["username"]);
        $password = $this->filter($data["password"]);
        $re_password = $this->filter($data["re_password"]);

        if (!empty($password) and $password == $re_password) {
            $password_hash = $this->password_hash($password);
            if (!empty($user_name) and !empty($mobile) and is_numeric($mobile) and !empty($password_hash)) {
                $result = $this->Do_select("select * from `users` where username=?", [$user_name], 1);
                if (empty($result)) {
                    $is_mobile = $this->Do_select("select * from `users` where mobile=?", [$mobile], 1);
                    if ($is_mobile["mobile"] == $mobile) {
                        $_SESSION["user_register"] = "is_mobile";
                    } else {
                        $registered = $this->Do_Query("insert into `users` (`username`,`password`,`mobile`) VALUES (?,?,?)", [$user_name, $password_hash, $mobile]);
                        if ($registered == true) {
                            $_SESSION["user_register"] = "success";

//                            if (isset($_SESSION["product_before_login"]) and !empty($_SESSION["product_before_login"])) {
//                                $this->add_basket($_SESSION["product_before_login"]);
//                                unset($_SESSION["product_before_login"]);
//                                header("location:" . SITE_URL . "ecomm/basket");
//                            }


                            // insert SMS sender  code hear
                            $text = "  ثبت نام شما انجام شد
                            نام کاربری : $user_name
                            رمز ورود : $password 
                            http://www.imtit.com";
                            $this->send_sms($mobile, $text);
                            $text = "کاربر جدید در فروشگاه ثبت نام کرده است
                            نام کاربری : $user_name";
                            $this->send_sms("09124825249", $text);
                        } else {
                            $_SESSION["user_register"] = "danger";
                        }
                    }
                } else {
                    $_SESSION["user_register"] = "is_username";
                }
            } else {
                $_SESSION["user_register"] = "empty";
            }
        } else {
            $_SESSION["user_register"] = "password";
        }
        header("location:" . SITE_URL . "users/user_login");
    }

    function update_user_info($data = [])
    {
        $email = $this->filter($data["email"]);
        $name = $this->filter($data["name"]);
        $family = $this->filter($data["family"]);
        $address = $this->filter($data["address"]);
        $user_id = base64_decode($_SESSION['user_id']);
        if (empty($name) or empty($family) or empty($address)) {
            $_SESSION['user_update'] = "empty";
            header("location:" . SITE_URL . "users");
        } else {
            $result = $this->Do_Query("update `users` set `name`=? , `family`=? , email=?, address=?  where `id`=?", [$name, $family, $email, $address, $user_id]);
            if ($result == true) {
                $_SESSION['user_update'] = "success";
                if (isset($_SESSION["check_user_status"]) and !empty($_SESSION["check_user_status"])) {
                    unset($_SESSION["check_user_status"]);
                    header("location:" . SITE_URL . "ecomm/checkout");
                } else {
                    header("location:" . SITE_URL . "users");
                }
            } else {
                $_SESSION['user_update'] = "danger";
                header("location:" . SITE_URL . "users");
            }
        }
    }

    function get_orders()
    {
        $new_orders = "";
        $user_id = $this->filter(base64_decode($_SESSION['user_id']));
        $orders = $this->Do_Select("select * from ecomm_factors WHERE user_id=? order by `id` DESC ", [$user_id]);
        foreach ($orders as $order) {
            $order["date"] = $this->convert_date($order["date"]);
            $new_orders [] = $order;
        }
        return $new_orders;
    }

    function add_basket($data = [])
    {
        $product_id = $this->filter($data);
        $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
        if (!empty($product_id) and !empty($user_id)) {
            $is_email = $this->Do_Select("select * from ecomm_basket WHERE `user_id`=? and `product_id`=? ", [$user_id, $product_id]);
            if (empty($is_email)) {
                $result = $this->Do_Query("insert into ecomm_basket (user_id,product_id) values(?,?)  ", [$user_id, $product_id]);
                if ($result) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                $result = $this->Do_Query("update   ecomm_basket set `count`=`count`+1 WHERE user_id=? and  product_id=?  ", [$user_id, $product_id]);
                if ($result) {
                    echo true;
                } else {
                    echo false;
                }
            }
        } else {
            echo false;
        }
    }

    function get_favorites()
    {
        $user_id = $this->filter(base64_decode($_SESSION['user_id']));
        $favorites = $this->Do_Select("select * from `ecomm_favorit` left join  ecomm_products  on  ecomm_favorit.product_id=ecomm_products.id  where   ecomm_favorit.`user_id`=?", [$user_id]);
        return $favorites;
    }

//  old
    function check_login($mobile = '', $password = '')
    {
        $mobile = $this->filter($mobile);
        $password = $this->filter($password);
        if (!empty($mobile) and !empty($password)) {
            $is_users_number = $this->Do_Select('select * from `users` WHERE `mobile`=?', [$mobile], 1);
            if ($is_users_number and !empty($is_users_number['password'])) {
                if ($this->password_verify($password, $is_users_number['password'])) {
                    $last_login = $this->time_to_jalali_date('DT');
                    $this->Do_Query('update users set last_login=? where id=?', [$last_login['date'] . ' - ' . $last_login['time'], $is_users_number['id']]);

                    $str_cod = $this->str_cod(20);

                    $_SESSION['user_id'] = base64_encode($is_users_number['id']);
                    $_SESSION['user'] = $str_cod;
                    $_SESSION['user_sex'] = $is_users_number['sex'];
                    setcookie("user", $str_cod, time() + 1000, "/"); // 1000 = 16:30 min

                    $onlines_info = $this->Do_Select(" select * from `onlines` where `type`='user' and `user_id`=? and `online`='on'", [$is_users_number['id']]);
                    if (empty($onlines_info)) {
                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['user', $is_users_number['id'], $is_users_number['name'] . ' ' . $is_users_number['family'], $is_users_number['mobile'], $this->ip(), time(), $str_cod]);
                    } else if (!empty($onlines_info)) {
                        $this->Do_Query("update `onlines` set `online`='off' WHERE  `type`='user' and `user_id`=? and `online`='on' ", [$is_users_number['id']]);
                        $this->Do_Query('insert into onlines (`type`,`user_id`,`name`,`username`,`IP`,`login_time`,`session`) VALUES (?,?,?,?,?,?,?)', ['user', $is_users_number['id'], $is_users_number['name'] . ' ' . $is_users_number['family'], $is_users_number['mobile'], $this->ip(), time(), $str_cod]);
                    }

                    return true;
                } else {
                    return 'pass';
                }
            } else {
                return 'info';
            }
        }
    }

}