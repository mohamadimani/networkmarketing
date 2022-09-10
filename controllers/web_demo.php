<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 11:04 PM
 */
class  web_demo extends controller
{

    function __construct()
    {
    }

    function index()
    {
        $get_demo_sub_category = $this->model->get_demo_category();
        $get_projects = $this->model->get_projects();
        $data = [
            'projects' => $get_projects,
            'demo_sub_category' => $get_demo_sub_category,
        ];
        $this->ecomm_view('demo/index', $data);
    }

    function get_all_demo()
    {
        $this->model->get_all_demo($_POST);
    }

    function all_demo($category = "")
    {
        $get_all_demo = $this->model->get_all_demo2($category);
        $category_info = $this->model->category_info($category);
        $data = [
            'category_info' => $category_info,
            'all_demo' => $get_all_demo,
        ];
        $this->ecomm_view('demo/demoes', $data);
    }


}