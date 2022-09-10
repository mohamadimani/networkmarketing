<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_clerk_list extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_clerks($user_id = "")
    {
        $user_id = $this->filter($user_id);
        if (empty($user_id)) {
            return $this->Do_Select("select * from `user` order BY `id` desc");
        } elseif (!empty($user_id)) {
            $user_result = $this->Do_Select("select * from `user` WHERE `id`=?", [$user_id], 1);
            $access_result = $this->Do_Select("select * from `user_access` WHERE `user_id`=?", [$user_id]);
            return ["user_info" => $user_result, "access_info" => $access_result];
        }
    }

    function get_access()
    {
        return $this->Do_Select("select * from `access_list`  where `status`='ACTIVE' ");
    }

    function user_status_change($id = '', $status = "")
    {
        $id = $this->filter($id);
        $status = $this->filter($status);
        if (!empty($id) and !empty($status)) {
            $status2 = '';
            if ($status == 'active') {
                $status2 = 'ACTIVE';
            } elseif ($status == 'inactive') {
                $status2 = 'INACTIVE';
            }
            return $this->Do_Query("update `user`  set  `status`=? WHERE id=? AND `username`!='admin' ", [$status2, $id]);
        }
    }

    function user_access_change($data = '')
    {
        $user_id = $this->filter($data['user_id']);
        $access_id = $this->filter($data['access_id']);
        $status = $this->filter($data['status']);
        if (!empty($user_id) and !empty($status) and !empty($access_id)) {
            $access_name = $this->Do_Select("select `EN_name` from `access_list` where `id`=?", [$access_id], 1);
            if ($status == 'active') {
                $result = $this->Do_Query("insert into `user_access`(`user_id`,`access`)VALUES (?,?)", [$user_id, $access_name["EN_name"]]);
                if ($result == true) {
                    return true;
                } else {
                    return false;
                }
            } elseif ($status == 'inactive') {
                $result = $this->Do_Query("delete from  `user_access` WHERE `access`=? AND `user_id`=?", [$access_name["EN_name"], $user_id]);
                if ($result == true) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }


//   ========   old    =========
    function admin_idea_room()
    {
        return $this->Do_Select("select * from `idea_room_employ` ORDER by  `id` DESC ");
    }

    function save_user_status_change($user_id = "")
    {
        $user_id = $this->filter($user_id);
        if (!empty($user_id) and is_numeric($user_id)) {
            $result = $this->Do_Query("update `idea_room_employ` set `status`='SEEN' where `id`=?  ", [$user_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function set_logout_log($row_id = '')
    {
//        $type = $this->filter($type);
        $row_id = $this->filter($row_id);
        $result = $this->Do_Query("update `onlines` set `online`='off' WHERE  `id`=? ", [$row_id]);
        return $result;
    }

    function get_onlines()
    {
        return $this->Do_Select("select * from `onlines` where `online`=?   ORDER BY `login_time` DESC     ", ['on']);
    }


}