<?php

/**
 * Created by PhpStorm.
 * User: mani
 * Date: 02/02/2019
 * Time: 10:49 AM
 */
class userresume extends controller
{

    function __construct()
    {

    }


    function index()
    {
        $captcha = $this->model->get_captcha();
        $data = ["captcha"=>$captcha];
        $this->admin_view('admin/user_resume', $data);
    }


    function save_resume()
    {
        $this->model->save_resume($_POST);

    }

}