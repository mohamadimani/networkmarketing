<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_resume extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_resume($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $result = $this->Do_Select("select * from `resume`  ORDER  by  `id` DESC ");
            return $result;
        } else if (!empty($id)) {
            $result = $this->Do_Select("select * from `resume`  where `id`=? ", [$id], 1);
            return $result;
        }
    }

    function update_resume_status($resume_id = "")
    {
        $resume_id = $this->filter($resume_id);
        $this->Do_Query("update `resume`  set `status`='SEEN'  WHERE `id`=?", [$resume_id]);
    }

}