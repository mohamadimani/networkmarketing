<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_web_demo extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_demo_category()
    {
        $demo_category = $this->Do_Select("select * from  `demo_category` WHERE   parent=0", []);
        return $demo_category;
    }

    function get_all_demo($category_id = [])
    {
        $category_id = $this->filter($category_id["category_id"]);
        //    $demo_category = $this->Do_Select("select id from  `demo_category` WHERE  cat_group=?", [$category_id]);
        $demo_category = $this->Do_Select("select demo_category.*,demo_category.title as cet_title ,demo_category.id  as cet_id ,`demo`.* from  `demo` left join demo_category on demo.category=demo_category.id  WHERE  demo_category.cat_group=? and demo.status='ACTIVE' order by demo.id desc limit 0,4 ", [$category_id]);
        echo json_encode($demo_category);
    }

    function get_all_demo2($category_id = [])
    {
        $category_id = $this->filter($category_id);
        //    $demo_category = $this->Do_Select("select id from  `demo_category` WHERE  cat_group=?", [$category_id]);
        $demo_category = $this->Do_Select("select demo_category.*,demo_category.title as cet_title ,demo_category.id  as cet_id ,`demo`.* from  `demo` left join demo_category on demo.category=demo_category.id  WHERE  demo_category.cat_group=? and demo.status='ACTIVE' order by demo.id desc   ", [$category_id]);
        return $demo_category;
    }

    function category_info($category = "")
    {
        $category_info = $this->Do_Select("SELECT title FROM demo_category where id=?", [$category], 1);
        return $category_info;
    }

    function get_projects($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $projectss = $this->Do_Select("select * from `projects_info` where status='ACTIVE'  order by `id` desc  ", []);
            return $projectss;
        } elseif (!empty($id) and is_numeric($id)) {
            $projectss = $this->Do_Select("select * from `projects_info`  WHERE `id`=? and status='ACTIVE'   order by `id` desc ", [$id], 1);
            return $projectss;
        }

    }
}
