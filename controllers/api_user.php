<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
class api_user extends controller
{
    function __construct()
    {
    }

//    mobile API and web
    function android_register()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->mobile)) {
            $this->model->android_register($get_info->mobile);
        } else {
            $result = ["error" => "null_mobile", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_get_token()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->code)) {
            if (isset($get_info->mobile)) {
                $this->model->android_get_token($get_info->mobile, $get_info->code);
            } else {
                $result = ["error" => "null_mobile", "info" => null];
            }
        } else {
            $result = ["error" => "null_code", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_get_user_info()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->token)) {
            $this->model->android_get_user_info($get_info->user_info, $get_info->token);
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_user_info()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->token)) {
            $this->model->android_user_info($get_info->token);
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_user_login()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->user_name) and isset($get_info->password)) {
            $this->model->android_user_login($get_info->user_name, $get_info->password);
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_forget_password()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->user_name)) {
            $this->model->android_forget_password($get_info->user_name);
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

    function android_reset_password()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->code) and isset($get_info->user_name)) {
            $this->model->android_reset_password($get_info->user_name, $get_info->code);
        } else {
            $result = ["error" => "null_info", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

//    old
    function Update_Info()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));

        if (!isset($get_info->id)) {
            $result = ["error" => "error", "info" => "Name Not Set"];
            return $result;
        }
        if (!isset($get_info->name)) {
            $result = ["error" => "error", "info" => "Name Not Set"];
            return $result;
        }
        if (!isset($get_info->family)) {
            $result = ["error" => "error", "info" => "family Not Set"];
            return $result;
        }
        if (!isset($get_info->codemeli)) {
            $result = ["error" => "error", "info" => "family Not Set"];
            return $result;
        }
    }

    function api_logout()
    {
//        $this->model->set_logout_log('user');
        unset($_SESSION['token']);
        header("location:" . SITE_URL . "users/user_login");
    }


}
