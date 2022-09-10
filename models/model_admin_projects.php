<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_projects extends model
{

    function __construct()
    {
        parent::__construct();
    }


    function get_projects($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $projectss = $this->Do_Select("select * from `projects_info`  order by `id` desc ", []);
            return $projectss;
        } elseif (!empty($id) and is_numeric($id)) {
            $projectss = $this->Do_Select("select * from `projects_info`  WHERE `id`=?   order by `id` desc ", [$id], 1);
            return $projectss;
        }

    }

    function save_project($data = "")
    {
        $title = $this->filter($data["title"]);
        $introduction = $this->filter($data["introduction"]);
        $client = $this->filter($data["client"]);
        $start = $this->filter($data["start"]);
        $finish = $this->filter($data["finish"]);
        $progress = $this->filter($data["progress"]);
        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }

        print_r($finish);
        if (!empty($title and !empty($client) and !empty($progress) and !empty($start))) {
            $param = [$title, $introduction, $client, $start, $finish, $progress, $status];
            $projectss = $this->Do_Query(" insert into   `projects_info` (`title`,introduction,client ,start,finish,progress,`status`)  VALUES (?,?,?,?,?,?,?) ", $param);
            if ($projectss == true) {
                $_SESSION["save_projects"] = "success";
            } else {
                $_SESSION["save_projects"] = "danger";
            }
        } else {
            $_SESSION["save_projects"] = "empty";
        }
        header("location:" . SITE_URL . "admin_projects");
    }

    function project_status_change($id = "", $status = "")
    {
        $id = $this->filter($id);
        $status = $this->filter($status);
        if ($status == "active") {
            $status = "ACTIVE";
        }
        if ($status == "inactive") {
            $status = "INACTIVE";
        }
        if (!empty($id) and !empty($status)) {
            $result = $this->Do_Query("update `projects_info` set `status`=? where `id`=? ", [$status, $id]);
            echo true;
        } else {
            echo false;
        }
    }

//    function projects_delete($id = "")
//    {
//        $id = $this->filter($id);
//        if (!empty($id)) {
//            $post_count = $this->Do_Select(" select `id` from `gallery` where `projects`=? ", [$id], 1);
//            if ($post_count["id"] > 0) {
//                echo "posts";
//            } else if ($post_count["title"] == 0) {
//                $result = $this->Do_Query("delete   from `projects_info` where `id`=? ", [$id]);
//                return true;
//            }
//        } else {
//            return false;
//        }
//    }

    function update_project($data = "", $id = "")
    {
        $title = $this->filter($data["title"]);
        $introduction = $this->filter($data["introduction"]);
        $client = $this->filter($data["client"]);
        $start = $this->filter($data["start"]);
        $finish = $this->filter($data["finish"]);
        $progress = $this->filter($data["progress"]);
        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }

        $id = $this->filter($id);
        if (!empty($title) and !empty($client) and !empty($progress) and !empty($start) and !empty($id)) {
            $param = [$title, $introduction, $client, $start, $finish, $progress, $status, $id];
            $result = $this->Do_Query("update `projects_info` set  `title`=?,introduction=?,client=? ,start=?,finish=?,progress=?,`status`=? where `id`=? ", $param);
            if ($result == true) {
                $_SESSION["edit_projects"] = "success";
                header("location:" . SITE_URL . "admin_projects");
            } else {
                $_SESSION["edit_projects"] = "danger";
                header("location:" . SITE_URL . "admin_projects/edit_project/" . $id);
            }
        } else {
            $_SESSION["edit_projects"] = "empty";
            header("location:" . SITE_URL . "admin_projects/edit_project/" . $id);
        }
    }


}