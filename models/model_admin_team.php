<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_team extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_gallery()
    {
        $gallery = $this->Do_Select("select * from  team_gallery", []);
        return $gallery;
    }

    function user_name($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update team_gallery set `user_name`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function occupation($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update team_gallery set `occupation`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function status($name = '', $id = '', $status = '')
    {
        $name = $this->filter($name);
        $id = $this->filter($id);
        $status = $this->filter($status);
        if (!empty($name) and !empty($id) and !empty($status)) {
            if ($status == "active") {
                $status = "active";
            } else {
                $status = "inactive";
            }
            $sql = "update team_gallery set `status`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$status, $id]));
        }

    }


//old  ******

    function upload_gallery($file = "")
    {
        $filename = $this->filter($file['name']);
        $filesize = $this->filter($file['size']);
        $filetemp = $file['tmp_name'];
        $filetype = $this->filter($file['type']);
        $fileerror = $this->filter($file['error']);
        $uploadok = 0;


        $target = 'public/images/team/';
        $newname = time();
        if ($filetype == 'image/jpg' or $filetype == 'image/jpeg' or $filetype == 'image/png') {
            $uploadok = 1;
        }
        if ($filesize >= 16000000) {
            $uploadok = 0;
        }
        if ($uploadok == 1) {
            $exe = pathinfo($filename, PATHINFO_EXTENSION);
            $target2 = $target . $newname . '.' . $exe;
            move_uploaded_file($filetemp, $target2);
            $imgname = $newname . '.' . $exe;
            $sql = "insert into   team_gallery (`img_name`) VALUES (?)   ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $imgname);
            $stmt->execute();
        }
        header("location:" . SITE_URL . "admin_team");

    }

    function delete_img($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $img_name = $this->Do_Select("select img_name from team_gallery where `id`=?", [$id], 1);
            $file = "public/images/gallery/" . $img_name["img_name"];
            if (file_exists($file)) {
                unlink($file);
            }
            $sql = "delete from team_gallery   where `id`=? ";
            $this->Do_Query($sql, [$id]);
            return true;
        }
    }

    function update_category($cat_id = "", $img_id = "")
    {
        $cat_id = $this->filter($cat_id);
        $img_id = $this->filter($img_id);
        if (!empty($cat_id) and !empty($img_id)) {
            $result = $this->Do_Query("update `team_gallery`  set `category`=? where `id`=? ", [$cat_id, $img_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function get_gallery_category()
    {
        $gallery = $this->Do_Select("select * from  `team_gallery_category` WHERE `status`='ACTIVE' ", []);
        return $gallery;
    }

}