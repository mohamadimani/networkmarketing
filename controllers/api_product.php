<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 01:23 PM
 */
class api_product extends controller
{
    function __construct()
    {
    }

    function get_product_list()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->token)) {
            $this->model->get_product_list($get_info->token);
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }
    function get_product_info()
    {
        $result = [];
        $get_info = json_decode(file_get_contents('php://input'));
        if (isset($get_info->token)and isset($get_info->product_id)) {
            $this->model->get_product_info($get_info->token,$get_info->product_id);
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        if (!empty($result)) {
            echo json_encode($result);
        }
    }

}
