<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_index extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function x()
    {

    }

//    old
    function seen_page($page_name = "")
    {
        $this->seen_pages($page_name);
    }
}