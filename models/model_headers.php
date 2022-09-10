<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_headers extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_ecomm_menu()
    {
        $ecomm_menu = $this->Do_Select("select  * from   `ecomm_menu`    WHERE    `status`='ACTIVE'  ORDER by `position` ASC ");
        return $ecomm_menu;
    }

    function get_user_info()
    {
        if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
            $user_id = $this->filter(base64_decode($_SESSION['user_id']));
            $user_info = $this->Do_Select("select  * from   `users` where id=?", [$user_id], 1);
            return $user_info;
        } else {
            return "";
        }
    }

    function get_ecomm_category()
    {
        $ecomm_full_menu = [];
        $ecomm_menus = $this->Do_Select("select  * from   `ecomm_product_category`    WHERE    `status`='ACTIVE' and parent=0  ");
        foreach ($ecomm_menus as $ecomm_menu) {
            $ecomm_inner_menu = $this->Do_Select("select    * from   `ecomm_product_category`  WHERE    `status`='ACTIVE' and parent=?  ", [$ecomm_menu["id"]]);
            $ecomm_menu["inner_menu"] = $ecomm_inner_menu;
            $ecomm_full_menu[] = $ecomm_menu;
        }
        return $ecomm_full_menu;
    }


}