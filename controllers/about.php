<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 11:04 PM
 */
class about extends controller
{

    function __construct()
    {

    }


    function index()
    {
        $team_gallery = $this->model->get_team_gallery();
        $site_about = $this->model->get_about();
        $data = ["site_about" => $site_about, "team_gallery" => $team_gallery];
        $this->view('web/about', $data);
    }


}