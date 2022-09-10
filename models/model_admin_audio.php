<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_audio extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_audio()
    {
        $audio = $this->Do_Select("select * from  audio", []);
        return $audio;
    }

    function get_audio_category()
    {
        $audio = $this->Do_Select("select * from  `audio_category` WHERE `status`='ACTIVE' ", []);
        return $audio;
    }

    function save_change($name = '', $id = '', $status = '')
    {
        $name = $this->filter($name);
        $id = $this->filter($id);
        $status = $this->filter($status);

        if (!empty($name) and !empty($status) and !empty($id) and $name == "img_show" and $status == "YES") {
            $sql = "update audio set img_show='YES' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "slider" and $status == "YES") {
            $sql = "update audio set slider='YES' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "img_show" and $status == "NO") {
            $sql = "update audio set img_show='NO' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "slider" and $status == "NO") {
            $sql = "update audio set slider='NO' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
    }

    function set_link($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update audio set `link`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function set_alt($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update audio set `alt`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function upload_audio($file = "")
    {
        $filename = $this->filter($file['name']);
        $filesize = $this->filter($file['size']);
        $filetemp = $file['tmp_name'];
        $filetype = $this->filter($file['type']);
        $fileerror = $this->filter($file['error']);
        $uploadok = 0;

//        print_r($file);
//        die();

        $target = 'public/audio/';
        $newname = time();
        if ($filetype == 'audio/mp3' or $filetype == 'audio/avi') {
            $uploadok = 1;
        }
        if ($filesize >= 50000000) { //50 MB
            $uploadok = 0;
        }
        if ($uploadok == 1) {
            $exe = pathinfo($filename, PATHINFO_EXTENSION);
            $target2 = $target . $newname . '.' . $exe;
            move_uploaded_file($filetemp, $target2);
            $imgname = $newname . '.' . $exe;
            $sql = "insert into   audio (`img_name`) VALUES (?)   ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $imgname);
            $stmt->execute();
        }
        header("location:" . SITE_URL . "admin_audio");

    }

    function delete_img($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $img_name = $this->Do_Select("select img_name from audio where `id`=?", [$id], 1);
            $file = "public/audio/" . $img_name["img_name"];
            if (file_exists($file)) {
                unlink($file);
            }
            $sql = "delete from audio   where `id`=? ";
            $this->Do_Query($sql, [$id]);
            return true;
        }
    }

    function update_category($cat_id = "", $img_id = "")
    {
        $cat_id = $this->filter($cat_id);
        $img_id = $this->filter($img_id);
        if (!empty($cat_id) and !empty($img_id)) {
            $result = $this->Do_Query("update `audio`  set `category`=? where `id`=? ", [$cat_id, $img_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function get_category($id = "")
    {
        $id = $this->filter($id);
        if (empty($id)) {
            $categorys = $this->Do_Select("select * from `audio_category`  order by `id` desc ", []);
            return $categorys;
        } elseif (!empty($id) and is_numeric($id)) {
            $categorys = $this->Do_Select("select * from `audio_category`  WHERE `id`=?   order by `id` desc ", [$id], 1);
            return $categorys;
        }

    }

    function category_status_change($id = "", $status = "")
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
            $result = $this->Do_Query("update `audio_category` set `status`=? where `id`=? ", [$status, $id]);
            return true;
        } else {
            return false;
        }
    }

    function category_delete($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $post_count = $this->Do_Select(" select `id` from `audio` where `category`=? ", [$id], 1);
            if ($post_count["id"] > 0) {
                echo "posts";
            } else if ($post_count["title"] == 0) {
                $result = $this->Do_Query("delete   from `audio_category` where `id`=? ", [$id]);
                return true;
            }
        } else {
            return false;
        }
    }

    function save_category($data = "")
    {
        $name = $this->filter($data["title"]);

        if (isset($data["status"])) {
            $status = $this->filter($data["status"]);
        }
        if (empty($status)) {
            $status = "INACTIVE";
        } else {
            $status = "ACTIVE";
        }


        if (!empty($name)) {
            $categorys = $this->Do_Query(" insert into   `audio_category` (`title`, `status`)  VALUES (?,?) ", [$name, $status]);
            if ($categorys == true) {
                $_SESSION["save_category"] = "success";
                header("location:" . SITE_URL . "admin_audio/category");
            } else {
                $_SESSION["save_category"] = "danger";
                header("location:" . SITE_URL . "admin_audio/category");
            }
        } else {
            $_SESSION["save_category"] = "empty";
            header("location:" . SITE_URL . "admin_audio/category");
        }

    }

    function update_category_title($data = "", $id = "")
    {
        $name = $this->filter($data["name"]);
        $id = $this->filter($id);
        if (!empty($name) and !empty($id)) {
            $result = $this->Do_Query("update `audio_category` set `title`=? where `id`=? ", [$name, $id]);
            if ($result == true) {
                $_SESSION["edit_audio_category"] = "success";
                header("location:" . SITE_URL . "admin_audio/category");
            } else {
                $_SESSION["edit_audio_category"] = "danger";
                header("location:" . SITE_URL . "admin_audio/edit_category/" . $id);
            }
        } else {
            $_SESSION["edit_audio_category"] = "empty";
            header("location:" . SITE_URL . "admin_audio/edit_category/" . $id);
        }
    }


}