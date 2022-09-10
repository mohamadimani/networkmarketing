<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 11:04 PM
 */
class blog extends controller
{

    function __construct()
    {

    }


    function index()
    {
        $site_about = $this->model->get_blog();
        $data = [  "blog" => $site_about];
        $this->view('web/blog', $data);
    }


}