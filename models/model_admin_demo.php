<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_demo extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_demo_category($category_id = "")
    {
        if (empty($category_id)) {
            $demo_category = $this->Do_Select("select * from  `demo_category` WHERE   parent=0", []);
        } else {
            $demo_category = $this->Do_Select("select * from  `demo_category` WHERE  parent=?", [$category_id]);
        }
        return $demo_category;
    }

    function get_category_info($category_id = "")
    {
        $category_info = $this->Do_Select("SELECT * FROM demo_category where id=?", [$category_id], 1);
        return $category_info;
    }

    function add_category($data = "", $cat_id = "")
    {
        $cat_id = $this->filter($cat_id);
        $title = $this->filter($data["name"]);
        $status1 = $this->filter($data["status"]);

        if ($status1 == "on") {
            $status = "ACTIVE";
        } elseif (empty($status1)) {
            $status = "INACTIVE";
        }

        if (!empty($title) and !empty($status)) {
            $cat_result = $this->Do_Query("insert into  demo_category (`title`,`status`,`parent`) VALUES (?,?,?)", [$title, $status, $cat_id]);
            $last_id = $this->conn->lastInsertId();
            if ($cat_result) {
                if ($cat_id == 0) {
                    $cat_result = $this->Do_Query("update    demo_category  set  cat_group=? where `id`=? ", [$last_id, $last_id]);
                } else {
                    $result = $this->Do_Select("select `cat_group` from demo_category    WHERE `id`=?", [$cat_id], 1);
                    $cat_result = $this->Do_Query("update    demo_category  set  cat_group=? where `id`=? ", [$result["cat_group"], $last_id]);
                }
                $_SESSION["add_demo_category"] = "success";
            } else {
                $_SESSION["add_demo_category"] = "danger";
            }
        } else {
            $_SESSION["add_demo_category"] = "empty";
        }
        header("location:" . SITE_URL . "admin_demo/category/" . $cat_id);
    }

    function category_status_change($data = "")
    {
        $category_id = $this->filter($data["id"]);
        $category_status = $this->filter($data["status"]);
        if ($category_status == "active") {
            $category_status = "ACTIVE";
        } elseif ($category_status == "inactive") {
            $category_status = "INACTIVE";
        }
        if (!empty($category_status) and !empty($category_id)) {
            $result = $this->Do_Query("update demo_category set `status`=? WHERE `id`=?", [$category_status, $category_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    function delete_category($data = "")
    {
        $category_id = $this->filter($data["id"]);
        if (!empty($category_id)) {
            $is_child = $this->Do_Select("select * from demo_category WHERE `parent`=? ", [$category_id]);
            $is_product = $this->Do_Select("select * from demo WHERE `category`=? ", [$category_id]);
            if (empty($is_child) and empty($is_product)) {
                $result = $this->Do_Query("delete from demo_category WHERE `id`=? ", [$category_id]);
                if ($result == true) {
                    echo true;
                } else {
                    echo false;
                }
            } elseif (!empty($is_child) or !empty($is_product)) {
                echo 2;
            }
        }
    }

    function update_category($data = "", $cat_id = "")
    {
        $parent = $this->filter($data["parent"]);
        $name = $this->filter($data["name"]);
        $status = $this->filter($data["status"]);
        $cat_id = $this->filter($cat_id);
        if ($status == "on") {
            $status = "ACTIVE";
        } else {
            $status = "INACTIVE";
        }
        if (!empty($status) and !empty($name) and !empty($cat_id)) {
            $result = $this->Do_Query("update demo_category set `title`=? , `parent`=? , `status`=? where `id`=? ", [$name, $parent, $status, $cat_id]);
            if ($result == true) {
                $result = $this->Do_Select("select `cat_group` from demo_category   WHERE `id`=?", [$parent], 1);
                $cat_result = $this->Do_Query("update    demo_category set  cat_group=? where `id`=? ", [$result["cat_group"], $cat_id]);
                $_SESSION["edit_demo_category"] = "success";
                header("location:" . SITE_URL . "admin_demo/category/" . $parent);
            } else {
                $_SESSION["edit_demo_category"] = "warning";
                header("location:" . SITE_URL . "admin_demo/edit_category/" . $cat_id);
            }
        } else {
            $_SESSION["edit_demo_category"] = "empty";
            header("location:" . SITE_URL . "admin_demo/edit_category/" . $cat_id);
        }

    }

    function get_all_category($category_id = "")
    {
        $result1 = $this->Do_Select("select `cat_group` from demo_category   WHERE `id`=?", [$category_id], 1);
//        $category_childs = $this->Do_Select("select * from ecomm_product_category WHERE `parent`=? ORDER by `id` DESC ", [$category_id]);
        $result = $this->Do_Select("select * from demo_category WHERE cat_group NOT IN (?)  ORDER by `id` DESC ", [$result1["cat_group"]]);
        return $result;
    }

    function get_demo_gallery($category_id = "")
    {
//        $demo_category = $this->Do_Select("select id from  `demo_category` WHERE  cat_group=?", [$category_id]);
        $demo_category = $this->Do_Select("select demo_category.*,demo_category.id  as cet_id ,`demo`.* from  `demo` left join demo_category on demo.category=demo_category.id  WHERE  cat_group=?", [$category_id]);
        return $demo_category;
    }

//    demo demo
    function save_change($name = '', $id = '', $status = '')
    {
        $name = $this->filter($name);
        $id = $this->filter($id);
        $status = $this->filter($status);

        if (!empty($name) and !empty($status) and !empty($id) and $name == "demo_show" and $status == "YES") {
            $sql = "UPDATE `demo` SET `status` = 'ACTIVE' WHERE `demo`.`id` = ? ";
            print_r($this->Do_Query($sql, [$id]));
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "demo_show" and $status == "NO") {
            $sql = "UPDATE `demo` SET `status` = 'INACTIVE' WHERE `demo`.`id` = ? ";
            print_r($this->Do_Query($sql, [$id]));
        }
    }

    function set_link($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update demo set `link`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function set_alt($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update demo set `title`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function upload_demo($file = "", $category_id = "")
    {
        $filename = $this->filter($file['name']);
        $filesize = $this->filter($file['size']);
        $filetemp = $file['tmp_name'];
        $filetype = $this->filter($file['type']);
        $fileerror = $this->filter($file['error']);
        $uploadok = 0;


        $target = 'public/images/demo/';
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
            $sql = "insert into   demo (`img_name`,`category`) VALUES (?,?) ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $imgname);
            $stmt->bindParam(2, $category_id);
            $stmt->execute();
        }
        header("location:" . SITE_URL . "admin_demo/gallery/" . $category_id);

    }

    function delete_img($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $img_name = $this->Do_Select("select img_name from demo where `id`=?", [$id], 1);
            $file = "public/images/demo/" . $img_name["img_name"];
            if (file_exists($file)) {
                unlink($file);
            }
            $sql = "delete from demo   where `id`=? ";
            $this->Do_Query($sql, [$id]);
            return true;
        }
    }

    function update_demo_category($cat_id = "", $img_id = "")
    {
        $cat_id = $this->filter($cat_id);
        $img_id = $this->filter($img_id);
        if (!empty($cat_id) and !empty($img_id)) {
            $result = $this->Do_Query("update `demo`  set `category`=? where `id`=? ", [$cat_id, $img_id]);
            if ($result == true) {
                echo true;
            } else {
                echo false;
            }
        }
    }

}
