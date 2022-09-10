<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_api_user extends model
{

    function __construct()
    {
        parent::__construct();
    }

//    function mobile_check($mobile = '')
//    {
//        $mobile = $this->filter($mobile);
//        $is_users_number = $this->Do_Select(' select mobile , token_code from users WHERE mobile=? ', [$mobile], 1);
//        if (empty($is_users_number['mobile'])) {
//            return true;
//        } else {
//            if (empty($is_users_number['token_code'])) {
//
//            } else {
//
//            }
//            return false;
////            return true;
//        }
//
//    }

    function android_register($mobile = "")
    {
        $result = [];
        $mobile = filter_var($this->filter($mobile), FILTER_SANITIZE_NUMBER_INT);
        $filter = "/^09\d{9}$/";
        if (preg_match($filter, $mobile)) {
            $user_info = $this->Do_Select(' select mobile , password  from users WHERE mobile=? ', [$mobile], 1);
            if (empty($user_info['mobile'])) {
                if (empty($user_info['password'])) {
                    $register_code = rand(1111, 9999);
                    $status = $this->Do_Query('insert into users(`mobile`,register_code,register_device)  VALUES (?,?,?)', [$mobile, $register_code, "null"]);
                    if ($status) {
//               sms code here
                        $result = ["error" => "success", "info" => $register_code];
                    } else {
                        $result = ["error" => "server", "info" => null];
                    }
                }
            } else if (!empty($user_info['mobile']) and !empty($user_info['password'])) {
                $result = ["error" => "is_mobile", "info" => null];
            } else if (!empty($user_info['mobile']) and empty($user_info['password'])) {
                $register_code = rand(1111, 9999);
                $status = $this->Do_Query('update  users set register_code=?,register_device=? where mobile=?', [$register_code, "null", $mobile]);
                if ($status) {
//               sms code here
                    $result = ["error" => "success", "info" => $register_code];
                } else {
                    $result = ["error" => "server", "info" => null];
                }
            }
        } else {
            $result = ["error" => "wrong_mobile", "info" => null];
        }
        echo json_encode($result);
    }

    function android_get_token($mobile = "", $code = "")
    {
        $code = $this->filter($code);
        $mobile = filter_var($this->filter($mobile), FILTER_SANITIZE_NUMBER_INT);
        $filter = "/^09\d{9}$/";
        if (preg_match($filter, $mobile)) {
            $register_code = $this->Do_Select("select register_code from users where mobile=?", [$mobile], 1);
            if (isset($register_code["register_code"])) {
                if ($register_code["register_code"] == $code) {
                    $str = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOsPQRSTUVWXYZ");
                    $token = substr($str, 0, 40);
                    $status = $this->Do_Query('update users set  `token_code`=? where mobile = ?', [$token, $mobile]);
                    if ($status) {
                        $result = ["error" => "success", "info" => $token];
                    } else {
                        $result = ["error" => "server", "info" => null];
                    }
                } else {
                    $result = ["error" => "wrong_code", "info" => null];
                }
            } else {
                $result = ["error" => "not_register", "info" => null];
            }
        } else {
            $result = ["error" => "wrong_mobile", "info" => null];
        }
        echo json_encode($result);
    }

    function android_get_user_info($user_info = "", $token = "")
    {
        $name = $this->filter($user_info->name);
        $family = $this->filter($user_info->family);
        $codemeli = $this->filter($user_info->codemeli);
        $password = $this->filter($user_info->password);
        $token = $this->filter($token);
        if (isset($name) and
            isset($family) and
            isset($codemeli) and
            isset($password)) {
            $password = $this->password_hash($password);
            $status = $this->Do_Query('update users set  `name`=?,family=?,codemeli=?,password=?  where token_code = ?', [$name, $family, $codemeli, $password, $token]);
//            $status = true;
            if ($status == true) {
                $result = ["error" => "success", "info" => "success"];
            } else {
                $result = ["error" => "server", "info" => null];
            }
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        echo json_encode($result);
    }

    function android_user_info($token = "")
    {
        $result = [];
        $token = $this->filter($token);
        if (!empty($token)) {
            $token_info = $this->Do_Select(' select `id`  from users WHERE token_code=? ', [$token], 1);
            if (!empty($token_info["id"])) {
                $user_info = $this->Do_Select(' select `id`, `name` , `family` , `address`,`mobile`,codemeli,email,img from users WHERE token_code=? ', [$token], 1);
                if (isset($user_info)) {
                    $user_info["net_code"] = "1234";
                    $user_info["dot_code"] = "5678";
                    $user_info["subset"] = "7";
                    $user_info["all_subset"] = "46";
                    $user_info["score"] = "510";
//                $user_info["img"] = SITE_URL . "public/images/users/" . $user_info["id"] . "/" . $user_info["img"];
                    $user_info["img"] = SITE_URL . "public/images/users/2/3.png";
                    $result = ["error" => "success", "info" => $user_info];
                } else {
                    $result = ["error" => "not_token", "info" => null];
//              $result = ["error" => $token, "info" => null];
                }
            } else {
                $result = ["error" => "wrong_token", "info" => null];
            }
        } else {
//            $result = ["error" => $token, "info" => null];
            $result = ["error" => "null_token", "info" => null];
        }
        echo json_encode($result);
    }

    function android_user_login($user_name = "", $password = "")
    {
        $result = [];
        $user_name = $this->filter($user_name);
        $password = $this->filter($password);

        if (!empty($user_name) and !empty($password)) {
            $user_info = $this->Do_Select(' select `id`, `name` , `family` , `address`,`mobile`,codemeli,email,img,password from users WHERE codemeli=? ', [$user_name], 1);
            if (!empty($user_info["codemeli"])) {
                if ($this->password_verify($password, $user_info['password'])) {
                    $str = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOsPQRSTUVWXYZ");
                    $token = substr($str, 0, 40);
                    $status = $this->Do_Query('update users set  `token_code`=? where codemeli = ? ', [$token, $user_name]);
                    if ($status) {
                        $user_info["net_code"] = "1234";
                        $user_info["dot_code"] = "5678";
                        $user_info["subset"] = "7";
                        $user_info["all_subset"] = "46";
                        $user_info["score"] = "510";
//                $user_info["img"] = SITE_URL . "public/images/users/" . $user_info["id"] . "/" . $user_info["img"];
                        $user_info["img"] = SITE_URL . "public/images/users/2/3.png";
                        $user_info["token_code"] = $token;
                        $user_info["password"] = "";
                        $result = ["error" => "success", "info" => $user_info];
                    } else {
                        $result = ["error" => "server", "info" => null];
                    }
                } else {
                    $result = ["error" => "wrong_password", "info" => null];
                }
            } else {
                $result = ["error" => "not_user", "info" => null];
            }
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        echo json_encode($result);
    }

    function android_forget_password($user_name = "")
    {
        $result = [];
        $user_name = $this->filter($user_name);
        if (!empty($user_name)) {
            $user_info = $this->Do_Select(' select mobile   from users WHERE codemeli=? ', [$user_name], 1);
            if (!empty($user_info["mobile"])) {
                $register_code = rand(1111, 9999);
                $status = $this->Do_Query('update users set `register_code`=? where codemeli = ? ', [$register_code, $user_name]);
                if ($status == true) {
//           sms code write here     $user_info["mobile"]
                    $result = ["error" => "success", "info" => $register_code];
                } else {
                    $result = ["error" => "server", "info" => null];
                }
            } else {
                $result = ["error" => "not_user", "info" => null];
            }
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        echo json_encode($result);
    }

    function android_reset_password($user_name = "", $code = "")
    {
        $result = [];
        $code = $this->filter($code);
        $user_name = $this->filter($user_name);
        if (!empty($code) and !empty($user_name)) {
            $user_code = $this->Do_Select(' select `register_code`, `mobile`  from  users WHERE codemeli=? ', [$user_name], 1);
            if (!empty($user_code["register_code"]) and $user_code["register_code"] == $code) {
                $new_password = rand(1111, 9999);
                $password = $this->password_hash($new_password);
                $status = $this->Do_Query('update users set `password`=? where codemeli = ? ', [$password, $user_name]);
                if ($status == true) {
//           sms code write here     $user_info["mobile"]
                    $result = ["error" => "success", "info" => $new_password];
                } else {
                    $result = ["error" => "server", "info" => null];
                }
            } else {
                $result = ["error" => "wrong_code", "info" => null];
            }
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        echo json_encode($result);
    }

//    old
    function set_logout_log($type = '')
    {
        $this->Do_Query("update `onlines` set `online`='off' WHERE `type`=? and `session`=? ", [$type, $_SESSION['user']]);
    }

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

    function android_register_users($mobile = '')
    {
        $mobile = filter_var($this->filter($mobile), FILTER_SANITIZE_NUMBER_INT);
        $filter = "/^09\d{9}$/";
        if (preg_match($filter, $mobile)) {
            if ($this->mobile_check($mobile)) {
                $register_code = rand(1111, 9999);

                $status = $this->Do_Query('insert into users(`mobile`,register_code,register_device)  VALUES (?,?,?)', [$mobile, $register_code, "android"]);
                if ($status) {
//                    $this->send_sms($mobile, "کد تایید : " . $register_code);
                    $result = ["error" => "success", "info" => $register_code];
                    echo json_encode($result);
                } else {
                    $result = ["error" => "error", "info" => "server"];
                    echo json_encode($result);
                }
            } else {
                $result = ["error" => "error", "info" => "is_mobile"];
                echo json_encode($result);
            }
        } else {
            $result = ["error" => "error", "info" => "wrong_mobile"];
            echo json_encode($result);
        }

    }

    function getHttpStatusMessage($statusCode)
    {
        $httpStatus = array(
            100 => ['Continue', "ادامه ارسال"],
            101 => ['Switching Protocols', "تعویض پروتکل ها"],
            102 => ['Processing', "در حال پردازش"],
            200 => ['OK', "درخواست موفق"],
            201 => ['Created', "ساخته شده"],
            202 => ['Accepted', "موافقت شده"],
            203 => ['Non-Authoritative Information', "اطلاعات غیر معتبر"],
            204 => ['No Content', "پاسخ بدون محتوا"],
            205 => ['Reset Content', "بازنشانی محتوا"],
            206 => ['Partial Content', "محتوای جزئی "],
            300 => ['Multiple Choices', "انتخاب چندگانه"],
            301 => ['Moved Permanently', " انتقال همیشگی"],
            302 => ['Found', "پیدا شد"],
            303 => ['See Other', "دیدن منبعی دیگر "],
            304 => ['Not Modified', "بدون تغییر"],
            305 => ['Use Proxy', " استفاده از پروکسی"],
            306 => ['Switch Proxy', "تعویض پروکسی"],
            307 => ['Temporary Redirect', "انتقال موقت"],
            400 => ['Bad Request', "درخواست بد"],
            401 => ['Unauthorized', " دسترسی نا معتبر "],
            402 => ['Payment Required', "نیاز به پرداخت"],
            403 => ['Forbidden', "دسترسی غیر مجاز"],
            404 => ['Not Found', "منبع درخواستی پیدا نشد "],
            405 => ['Method Not Allowed', "متد غیر مجاز "],
            406 => ['Not Acceptable', "غیر قابل قبول "],
            407 => ['Proxy Authentication Required', "نیاز به مجوز پروکسی"],
            408 => ['Request Timeout', "پایان حداکثر زمان درخواست"],
            409 => ['Conflict', "تعارض "],
            410 => ['Gone', "حذف شده "],
            411 => ['Length Required', "عدم ارسال طول درخواست "],
            412 => ['Precondition Failed', "پیش شرط رد شده"],
            413 => ['Request Entity Too Large', "درخواست خیلی طولانی"],
            414 => ['Request-URI Too Long', " آدرس وب خیلی طولانی"],
            415 => ['Unsupported Media Type', "فرمت پشتیبانی نشده"],
            416 => ['Requested Range Not Satisfiable', "حد درخواستی غیر اقناع کننده"],
            417 => ['Expectation Failed', "انتظارات رد شده"],
            500 => ['Internal Server Error', "خطای داخلی سرور"],
            501 => ['Not Implemented', "غیر مجهز یا تکمیل نشده"],
            502 => ['Bad Gateway', "خطای دروازه میانجی "],
            503 => ['Service Unavailable', "سرویس خارج از دسترس"],
            504 => ['Gateway Timeout', "پایان حداکثر زمان دروازه میانجی"],
            505 => ['HTTP Version Not Supported', "نسخه HTTP پشتیبانی نمی شود"]);
        return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $httpStatus[500];
    }

}