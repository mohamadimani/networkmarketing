<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_ecomm extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_new_products()
    {
        return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE' ORDER by ecomm_products.`id` desc limit 0,8  ");
    }

    function get_top_sell_products()
    {
        return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE' ORDER by ecomm_products.`sell_count` desc limit 0,8  ");
    }

    function get_top_view_products()
    {
        return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE' ORDER by ecomm_products.`view` desc limit 0,8  ");
    }

    function set_like($data = [])
    {
        $product_id = $this->filter($data["product_id"]);
        $param = $this->filter($data["param"]);
        if (!empty($_SESSION["user_id"])) {
            $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
            if (!empty($user_id) and !empty($product_id)) {
                $was_favorit = $this->Do_Select("select * from ecomm_likes WHERE product_id=? and user_id =? ", [$product_id, $user_id]);
                if (empty($was_favorit)) {
                    if (!empty($param) and $param == "like") {
                        $result = $this->Do_Query("update ecomm_products set likes=likes+1 WHERE `id`=?", [$product_id]);
                        $this->Do_Query("insert into ecomm_likes ( `product_id`,`user_id`,`status`) VALUES (?,?,?)", [$product_id, $user_id, $param]);
                        if ($result == true) {
                            echo true;
                        } else {
                            echo false;
                        }
                    } elseif (!empty($param) and $param == "dislike") {
                        $result = $this->Do_Query("update ecomm_products set dislikes=dislikes+1 WHERE `id`=?", [$product_id]);
                        $this->Do_Query("insert into ecomm_likes ( `product_id`,`user_id`,`status`) VALUES (?,?,?)", [$product_id, $user_id, $param]);
                        if ($result == true) {
                            echo true;
                        } else {
                            echo false;
                        }
                    }
                } else {
                    echo "was";
                }
            } else {
                echo false;
            }
        } else {
            echo "login";
        }
    }

    function add_favorit($product_id = "")
    {
        if (!empty($_SESSION["user_id"]) and isset($_SESSION["user_id"])) {
            $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
            $product_id = $this->filter($product_id);
            if (!empty($user_id) and !empty($product_id)) {
                $was_favorit = $this->Do_Select("select * from ecomm_favorit WHERE product_id=? and user_id =? ", [$product_id, $user_id]);
                if (empty($was_favorit)) {
                    $result = $this->Do_Query("insert into ecomm_favorit ( `product_id`,`user_id`) VALUES (?,?)", [$product_id, $user_id]);
                    if ($result == true) {
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo "was";
                }
            } else {
                echo false;
            }
        } else {
            echo "login";
        }
    }

    function newsletter($data = [])
    {
        $email = $this->filter($data["email"]);
        $is_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($is_email == $email) {
            $is_email = $this->Do_Select("select * from ecomm_newsletter WHERE `email`=? ", [$email]);
            if (empty($is_email)) {
                $this->Do_Query("insert into ecomm_newsletter (`email`) VALUES (?)", [$email]);
                echo true;
            } else {
                echo "was";
            }
        } else {
            echo false;
        }
    }

//  product
    function get_product_info($product_id = "")
    {
        $product_id = $this->filter($product_id);
        return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE' and ecomm_products.`id`=? ", [$product_id], 1);
    }

    function get_product_message($product_id = "")
    {
        $results_new = "";
        $product_id = $this->filter($product_id);
        $results = $this->DO_Select("select *  from ecomm_product_message LEFT JOIN `users`  on ecomm_product_message.`user_id`=`users`.`id`  where  ecomm_product_message.product_id=? and ecomm_product_message.`status`='ACTIVE' ORDER by ecomm_product_message.`id` desc   ", [$product_id]);

        foreach ($results as $result) {
            $result["date"] = $this->convert_date($result["date"]);
            $results_new [] = $result;
        }
        return $results_new;
    }

    function save_message($data = [], $product_id = "")
    {
        $message = $this->filter($data["message"]);
        $product_id = $this->filter($product_id);
        $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
        if (!empty($message) and !empty($product_id)) {
            $result = $this->Do_Query("insert into ecomm_product_message (`user_id`,`product_id`,`message`)  VALUES (?,?,?)", [$user_id, $product_id, $message]);
            if ($result == true) {
                $_SESSION ["save_message"] = "success";
            } else {
                $_SESSION ["save_message"] = "danger";
            }
        } else {
            $_SESSION ["save_message"] = "empty";
        }
        header("location:" . SITE_URL . "ecomm/product/" . $product_id);
    }

    function add_basket($data = [])
    {
        $product_id = $this->filter($data["product_id"]);
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

    function get_basket()
    {
        $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
        $is_basket = $this->Do_Select("select * from ecomm_basket LEFT  JOIN ecomm_products on ecomm_basket.product_id=ecomm_products.id WHERE ecomm_basket.`user_id`=?  ", [$user_id]);
        if (!empty($is_basket)) {
            return $is_basket;
        } else {
            return " ";
        }
    }

    function remode_basket_item($product_id = "")
    {
        $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
        $product_id = $this->filter($product_id);
        if (!empty($product_id) and !empty($user_id)) {
            $result = $this->DO_Query("delete from ecomm_basket WHERE `user_id`=? and `product_id`=?  ", [$user_id, $product_id]);
            if ($result) {
                $_SESSION["delete_basket_item"] = "success";
            } else {
                $_SESSION["delete_basket_item"] = "danger";
            }
        } else {
            $_SESSION["delete_basket_item"] = "empty";
        }
        header("location:" . SITE_URL . "ecomm/basket");
    }

    function user_info()
    {
        if (isset($_SESSION["user_id"]) and !empty(trim($_SESSION["user_id"]))) {

            $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
            $result = $this->Do_Select("select * from `users`  where `id`=? ", [$user_id], 1);
        } else {
            $result = [];
        }
        return $result;
    }

    function checkout($factor_id = "")
    {
        $user_info = $this->user_info();

        $name = trim($user_info["name"]);
        $family = trim($user_info["family"]);
        $address = trim($user_info["address"]);
        if (empty($name) or empty($family)) {
            $_SESSION["user_info"] = "قبل از خرید باید اطلاعات خود را کامل کنید";
            $_SESSION["check_user_status"] = "basket";
            header('location:' . SITE_URL . 'users');
        } else {


            $user_id = $this->filter(base64_decode($_SESSION["user_id"]));
            if (empty($factor_id)) {
                $basket_products = $this->get_basket();
                $sum_prices = 0;
                $sum_discounts = 0;
                $a = 0;
                foreach ($basket_products as $key => $products) {
                    $sum_price[$key] = ($products["price"] * $products["count"]);
                    $sum_discount[$key] = ceil(($sum_price[$key] * $products["discount"]) / 100);
                    $sum_prices += $sum_price[$key];
                    $sum_discounts += $sum_discount[$key];
                    $a++;
                }

                $user_name = $user_info["name"] . " " . $user_info["family"];
                $product_count = $a;
                $amount = $sum_prices - $sum_discounts;

                $param = [$user_name, $user_id, $product_count, $amount];
                $this->Do_Query("insert into ecomm_factors (user_name,user_id,product_count,amount) VALUES(?,?,?,?) ", $param);
                $factor_id = $this->conn->lastInsertId();
                //   set factor number
                $time = time();
                $year = date('Y', $time);
                $month = date('m', $time);
                $day = date('d', $time);
                $jalali_date = $this->gregorian_to_jalali($year, $month, $day);
                $jalali_date[0] = substr($jalali_date[0], 2, 3);
                if (strlen($jalali_date[1]) == 1) {
                    $jalali_date[1] = "0" . $jalali_date[1];
                } else {
                    $jalali_date[1] = $jalali_date[1];
                }
                $factor_number = "F-$jalali_date[0]$jalali_date[1]" . $factor_id;


                foreach ($basket_products as $key => $products) {
                    $product_info = $this->get_product_info($products["product_id"]);
                    $param2 = [$factor_id, $product_info["name"], $product_info["price"], $products["count"], $product_info["title"], $product_info["discount"]];
                    $this->Do_Query("insert into ecomm_factor_products (factor_id,product_name,`price`,`count`,category,discount) VALUES(?,?,?,?,?,?) ", $param2);
                }
                $result = $this->zarinpalRequest($amount, "imt_shop_" . $factor_number, "imtit@info.com", $user_info["mobile"]);
                $result_up = $this->Do_Query("update `ecomm_factors` set   `befor_pay`=? ,factor_number=? where `id`=?", [$result['Authority'], $factor_number, $factor_id]);
                if ($result_up) {
                    if ($result['Status'] == 100) {
                        $this->Do_Query("delete from  ecomm_basket where  user_id=?", [$user_id]);

                        // insert SMS sender  code hear
                        $text = "سفارش شما ثبت شده و در انتظار پرداخت است
شماره پیگیری :$factor_number";
                        $this->send_sms($user_info["mobile"], $text);
                        $_SESSION["factor_number"] = $factor_number;
                        header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['Authority']);
                    }
                } else {
                    header('location:' . SITE_URL . 'ecomm/basket');
                }
            } else if (!empty($factor_id)) {

                $factor_info = $this->Do_Select("select * from  ecomm_factors where id=? ", [$factor_id], 1);
                $result = $this->zarinpalRequest($factor_info["amount"], "imt_shop_" . $factor_info["factor_number"], "imtit@info.com", $user_info["mobile"]);
                $result_up = $this->Do_Query("update `ecomm_factors` set   `befor_pay`=?   where `id`=?", [$result['Authority'], $factor_id]);
                $_SESSION["factor_number"] = $factor_info["factor_number"];
                if ($result_up) {
                    if ($result['Status'] == 100) {
                        Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['Authority']);
                    }
                } else {
                    header('location:' . SITE_URL . 'users/orders');
                    $_SESSION["user_pay"] = "connect";
                }

            }
        }
    }

    function pay_veryfy($Authority = '', $status = '')
    {
        $user_info = $this->user_info();
        $user_inf = $user_info["name"];
        $factor_number = $_SESSION["factor_number"];
        unset($_SESSION["factor_number"]);
        $Authority = $this->filter($Authority);
        $status = $this->filter($status);
        $factor_info = $this->Do_Select("select `amount`  from `ecomm_factors` where `befor_pay`=? ", [$Authority], 1);
        $result2 = $this->zarinpalVerify($factor_info["amount"], $Authority);

        if ($result2['Status'] == 100) {
            $result_up = $this->Do_Query("update `ecomm_factors` set  `pay_status`='PAID', `after_pay`=?  where `befor_pay`=?", [$result2['RefID'], $Authority]);
            $_SESSION["user_pay"] = "success";

            // insert SMS sender  code hear

            $text = "$user_inf عزیز
فاکتور شماره  $factor_number  با موفقیت پرداخت شد
گروه تجاری آی ام تی www.imtit.com";
            $this->send_sms($user_info["mobile"], $text);
            header('location:' . SITE_URL . 'users/orders');
        } elseif ($result2['Status'] != 100) {
            $result_up = $this->Do_Query("update `ecomm_factors` set   `pay_error`=?   where `befor_pay`=?", [$result2['Error'], $Authority]);
            $_SESSION["user_pay"] = "danger";
            $_SESSION["user_error"] = $result2['Error'];

            // insert SMS sender  code hear

            $text = "$user_inf عزیز
فاکتور شماره $factor_number هنوز پرداخت نشده
گروه تجاری آی ام تی www.imtit.com";
            $this->send_sms($user_info["mobile"], $text);
            header('location:' . SITE_URL . 'users/orders');
        }
    }

    function get_cat_childeren($data = [])
    {
        $cat_id = $this->filter($data["cat_id"]);
        $ecomm_menu = $this->Do_Select("select  * from   `ecomm_product_category`    WHERE    `status`='ACTIVE' and parent=? ", [$cat_id]);
        echo json_encode($ecomm_menu);
    }

    function products($cat_id = "")
    {
        if (empty($cat_id)) {
            return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE'   ");
        } else {
            $cat_id = $this->filter($cat_id);
            return $this->DO_Select("select ecomm_products.* , ecomm_product_category.title from ecomm_products LEFT JOIN ecomm_product_category ON ecomm_products.`category`=ecomm_product_category.`id` where ecomm_products.`status`='ACTIVE' and ecomm_products.`category`=? ", [$cat_id]);
        }
    }

    function seen_product($product_id = "")
    {
        if (isset($_COOKIE["product_seen" . $product_id]) and !empty($_COOKIE["product_seen" . $product_id])) {

        } else {
            setcookie("product_seen" . $product_id, " ", time() + (60 * 60 * 24 * 7), "/");

            $product_id = $this->filter($product_id);
            $this->Do_Query("update `ecomm_products` set `view`=`view`+1 WHERE `id`=?", [$product_id]);
        }
    }

    function get_product_gallery($product_id = "")
    {
        $product_gallery = $this->Do_Select("select * from ecomm_product_gallery where product_id=? and status='ACTIVE' ", [$product_id]);
        return $product_gallery;
    }

    function get_product_attr($product_id = "")
    {
        $category = $this->Do_Select("select id ,`category` , `name` from  ecomm_products where `id`=? ", [$product_id], 1);
        $product_attrs = $this->Do_Select("select * from ecomm_category_attr where `category_id`=? and `status`='ACTIVE' and parent='0' ", [$category["category"]]);

        $all_attrs = [];
        foreach ($product_attrs as $attrs) {
            $product_attrs = $this->Do_Select("select ecomm_category_attr.*, ecomm_category_attr.id as attr_ids ,ecomm_product_attr.`value` from ecomm_category_attr LEFT join ecomm_product_attr on ecomm_category_attr.`id`=ecomm_product_attr.attr_id where ecomm_category_attr.`category_id`=? AND  ecomm_category_attr.`parent`=?    and ecomm_category_attr.`status`='ACTIVE' and ecomm_product_attr.`product_id`=?  ORDER by ecomm_category_attr.`id` ASC ", [$attrs["category_id"], $attrs["id"], $product_id]);
            $attrs["attr_child"] = $product_attrs;
            $all_attrs[] = $attrs;
        }
        return $all_attrs;
    }

    function get_law()
    {
        $basket = $this->get_basket();
        $all_price = 0;
        foreach ($basket as $product) {
            $price = $product["price"] * $product["count"];
            $product["sum_price"] = $price;
            $all_product[] = $product;
            $all_price = $all_price + $price;
        }

        $options = $this->Do_Select("select `posts_category`.`id` as `category_id` , `posts`.* from `posts_category` LEFT JOIN `posts` ON  `posts_category`.`id`=`posts`.`category` WHERE `posts_category`.`EN_name`='law'  AND `posts`.`status`='ACTIVE' ", [], 1);
        $new_data = $this->convert_date();
        $end_date = $this->convert_date();
        $options["new_date"] = $new_data;
        $options["end_date"] = $end_date;
        $options["price_number"] = $all_price;
        $options["price_str"] = $this->getNumberTitle($all_price) . " تومان ";
        return $options;
    }
}
