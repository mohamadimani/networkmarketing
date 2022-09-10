<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_ecomm_orders extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_all_orders()
    {
        $orders = $this->Do_Select("select * from ecomm_factors ORDER by id DESC ");
        foreach ($orders as $order) {
            $order["date"] = $this->convert_date($order["date"]);
            $new_orders [] = $order;
        }
        return $new_orders;
    }

    function orders_status_change($data = [])
    {
        $status = $this->filter($data["status"]);
        $order_id = $this->filter($data["id"]);
        if ($status == "active") {
            $status = "ACTIVE";
        } elseif ($status == "inactive") {
            $status = "INACTIVE";
        }
        if (!empty($status) and !empty($order_id)) {
            $result = $this->Do_Query("update ecomm_factors set status=? where id=?", [$status, $order_id]);
            if ($result) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    function get_factor_products($factor_id = "")
    {
        $factor_id = $this->filter($factor_id);
        $result = $this->Do_Select("select * from ecomm_factors LEFT join ecomm_factor_products ON ecomm_factors.id=ecomm_factor_products.`factor_id`  where ecomm_factors.`id`=?", [$factor_id]);
        foreach ($result as $order) {
            $order["date"] = $this->convert_date($order["date"]);
            $new_orders [] = $order;
        }
        return $new_orders;
    }

    function get_factor_products_print($factor_id = "")
    {
        $factor_id = $this->filter($factor_id);
        $result = $this->Do_Select("select * from ecomm_factors LEFT join ecomm_factor_products ON ecomm_factors.id=ecomm_factor_products.`factor_id`  where ecomm_factors.`id`=?", [$factor_id]);
        $user_info = $this->Do_Select("select * from  `users`  where `id`=? ", [$result[0]["user_id"]], 1);
        foreach ($result as $order) {
            $order["date"] = $this->convert_date($order["date"]);
            $new_orders [] = $order;
        }
        $sum_factor_price = $result[0]["amount"];
        $sum_factor_price_text = $this->getNumberTitle($sum_factor_price);
        $sum_factor_price = [$sum_factor_price, $sum_factor_price_text];
        return [$new_orders, $sum_factor_price, $user_info];
    }

    function factor_product_status_change($data = [])
    {
        $status = $this->filter($data["status"]);
        $order_id = $this->filter($data["id"]);
        if ($status == "active") {
            $status = "ACTIVE";
        } elseif ($status == "inactive") {
            $status = "INACTIVE";
        }
        if (!empty($status) and !empty($order_id)) {
            $result = $this->Do_Query("update ecomm_factor_products set product_status=? where id=?", [$status, $order_id]);
            if ($result) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    function set_count($data = [])
    {
        $id = $this->filter($data["id"]);
        $value = $this->filter($data["value"]);
        if (is_numeric($value) and $value < 11) {
            if (!empty($id) and !empty($value)) {
                $result = $this->Do_Query("update ecomm_factor_products set `count`=? where `id`=? ", [$value, $id]);
                if ($result) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }

    function set_discount($data = [])
    {
        $id = $this->filter($data["id"]);
        $value = $this->filter($data["value"]);
        if (is_numeric($value) and $value < 91) {
            if (!empty($id) and !empty($value)) {
                $result = $this->Do_Query("update ecomm_factor_products set `discount`=? where `id`=? ", [$value, $id]);
                if ($result) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    }
}
