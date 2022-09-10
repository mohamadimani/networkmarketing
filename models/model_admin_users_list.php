<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_users_list extends model
{


    function __construct()
    {
        parent::__construct();
    }

    function get_users()
    {
        return $this->Do_Select("select * from users order BY `id` desc");
    }

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

    function user_status_change($id = '', $status = "")
    {
        $id = $this->filter($id);
        $status = $this->filter($status);
        if (!empty($id) and !empty($status)) {
            $status2 = '';
            if ($status == 'active') {
                $status2 = 'active';
            } elseif ($status == 'inactive') {
                $status2 = 'inactive';
            }
            return $this->Do_Query("update `users`  set  `status`=? WHERE id=?", [$status2, $id]);
        }
    }

//   ========   old    =========
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