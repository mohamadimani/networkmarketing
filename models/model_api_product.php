<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_api_product extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_product_list($token = "")
    {
        $result = [];
        $token = $this->filter($token);
        if (!empty($token)) {

            $token_info = $this->Do_Select(' select `id`  from users WHERE token_code=? ', [$token], 1);
            if (!empty($token_info["id"])) {
                $products = $this->Do_Select("select id,price,category,`name`,`image` , likes,dislikes from ecomm_products where `status`='ACTIVE' ");
                if ($products == true) {
                    $result = ["error" => "success", "info" => $products];
                } else {
                    $result = ["error" => "server", "info" => null];
                }
            } else {
                $result = ["error" => "wrong_token", "info" => null];
            }
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        echo json_encode($result);
    }

    function get_product_info($token = "", $product_id = "")
    {
        $result = [];
        $token = $this->filter($token);
        $product_id = $this->filter($product_id);
        if (!empty($token) and !empty($product_id)) {
            $token_info = $this->Do_Select(' select `id`  from users WHERE token_code=? ', [$token], 1);
            if (!empty($token_info["id"])) {
                $products = $this->Do_Select("select id,price,category,`summary`,`name`,`image` , likes,dislikes from ecomm_products where `status`='ACTIVE' and `id`=? ", [$product_id], 1);
                if (!empty($products["id"])) {

                    $sum_likes = $products["likes"] + $products["dislikes"];

                    $products["likes"] = "";
                    $products["dislikes"] = "";
                    $result = ["error" => "success", "info" => $products];
                } else {
                    $result = ["error" => "not_find", "info" => null];
                }
            } else {
                $result = ["error" => "wrong_token", "info" => null];
            }
        } else {
            $result = ["error" => "null_token", "info" => null];
        }
        echo json_encode($result);
    }

}