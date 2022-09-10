<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 11:04 PM
 */
class single extends controller
{

    function __construct()
    {

    }


    function index($post_id = '')
    {
        $site_about = $this->model->get_blog($post_id);
        $data = ["single" => $site_about];
        $this->view('web/single', $data);
    }

    function seen_post()
    {
        $this->model->seen_post($_POST["post_id"]);
    }


}