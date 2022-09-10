<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_posts extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_categorys()
    {
        $site_category = $this->Do_Select("select * from `posts_category` WHERE `status`='ACTIVE' ORDER BY id DESC ", []);
        return $site_category;
    }

    function get_post($post_id = '')
    {
        $post_id = $this->filter($post_id);
        $post = $this->Do_Select("select * from `posts`  where `id`=?", [$post_id], 1);
        return $post;
    }

    function get_posts($item = "")
    {
        $site_posts2 = [];
        if (empty($item)) {
            $site_posts = $this->Do_Select("select `posts`.* ,`posts_category`.`name` from  `posts` LEFT JOIN `posts_category` on `posts`.`category`=`posts_category`.`id` where `posts`.`status`!='DELETE' ORDER BY creat_date DESC  ", []);
        } elseif (!empty($item) and $item == "delete") {
            $site_posts = $this->Do_Select("select `posts`.* ,`posts_category`.`name` from  `posts` LEFT JOIN `posts_category` on `posts`.`category`=`posts_category`.`id` where `posts`.`status`='DELETE' ORDER BY id DESC  ", []);
        }
        foreach ($site_posts as $post) {
            $date = $this->convert_date($post["creat_date"]);
            $post["date"] = $date;

            $post["content"] = $this->sub_text($post['contect'], 50);
            array_push($site_posts2, $post);
        }
        return $site_posts2;
    }

    function post_status_change($id = "", $status = "")
    {

        $id = $this->filter($id);
        $status = $this->filter($status);
        if ($status == "active") {
            $status = "ACTIVE";
        }
        if ($status == "inactive") {
            $status = "INACTIVE";
        }

        if ($status == "delete") {
            $status = "DELETE";
        }

        if (!empty($id) and !empty($status)) {
            $last_post_status = $this->Do_Select("select `status` from  `posts`  where `id`=?  ", [$id], 1);
            $result = $this->Do_Query("update `posts` set `status`=? where `id`=? ", [$status, $id]);
            if ($result == true) {
                $result_select = $this->Do_Select("select `category` from  `posts`  where `id`=?  ", [$id], 1);
                if ($status == "DELETE") {
                    $result_update = $this->Do_Query("update  `posts_category`  set `posts`=`posts`-1  where `id`=?  ", [$result_select["category"]]);
                }
                if ($status == "INACTIVE" and $last_post_status["status"] == "DELETE") {
                    $result_update = $this->Do_Query("update  `posts_category`  set `posts`=`posts`+1  where `id`=?  ", [$result_select["category"]]);
                }
                print_r(true);
            } else {
                print_r(false);
            }
        } else {
            print_r(false);
        }
    }

    function insert_post($data = '', $file = "")
    {
        $file = $file["post_first_img"];
        $filename = $this->filter($file['name']);
        $filesize = $this->filter($file['size']);
        $filetemp = $file['tmp_name'];
        $filetype = $this->filter($file['type']);
        $fileerror = $this->filter($file['error']);
        $uploadok = 0;
        $title = $data["title"];
        $postcontent = $data["postcontent"];
        $category = $this->filter($data["category"]);
        $status = $this->filter($data["status"]);
        if ($status == 'active') {
            $status = 'ACTIVE';
        }
        if ($status == 'inactive') {
            $status = 'INACTIVE';
        }
        if (!empty($category) and !empty($title)) {

            $result = $this->Do_Query("insert into `posts` (`title`, `category`,`contect`,`status`) VALUES(?,?,?,?)", [$title, $category, $postcontent, $status]);
            $last_id = $this->conn->lastInsertId();
            mkdir('public/posts/' . $last_id);
            $result2 = $this->Do_Query("update  `posts_category`  set `posts`=`posts`+1  where `id`=?  ", [$category]);
            if ($result == true) {
//  =======  upload img for post ========

                $target = 'public/posts/' . $last_id . '/';
                $newname = time();
                if ($filetype == 'image/jpg' or $filetype == 'image/jpeg' or $filetype == 'image/png' or $filetype == 'image/gif') {
                    $uploadok = 1;
                }
                if ($filesize >= 160000000) {
                    $uploadok = 0;
                }
                if ($uploadok == 1) {
                    $exe = pathinfo($filename, PATHINFO_EXTENSION);
                    $target2 = $target . $newname . '.' . $exe;
                    $new_target = $target . "s_" . $newname . '.' . $exe;
                    move_uploaded_file($filetemp, $target2);
                    $this->creat_thumbnail($target2, $new_target, 255, 200);
                    $imgname = $newname . '.' . $exe;
                    $sql = "update `posts` set `img_name`=? WHERE `id`=?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindValue(1, $imgname);
                    $stmt->bindValue(2, $last_id);
                    $stmt->execute();
                    file_put_contents($target . "post_title.txt", "title => " . $title . "  |  category_id => " . $category);
                }
                $_SESSION["save_post"] = "success";
                header("location:" . SITE_URL . "admin_posts");
            } else {
                $_SESSION["save_post"] = "danger";
                header("location:" . SITE_URL . "admin_posts/add_post");
            }
        } else {
            $_SESSION["save_post"] = "empty";
            header("location:" . SITE_URL . "admin_posts/add_post");
        }
    }

    function update_post($data = '', $file = "", $post_id = "", $post_category = "")
    {
        $title = $data["title"];
        $postcontent = $data["postcontent"];
        $category = $this->filter($data["category"]);
        $status = $this->filter($data["status"]);
        if ($status == 'active') {
            $status = 'ACTIVE';
        }
        if ($status == 'inactive') {
            $status = 'INACTIVE';
        }
        if (!empty($category) and !empty($title)) {
            $result = $this->Do_Query("update  `posts` set  `title`=? ,`category`=?,`contect`=?,`status`=? WHERE `id`=?", [$title, $category, $postcontent, $status, $post_id]);
            if ($post_category != $category) {
                $result2 = $this->Do_Query("update  `posts_category`  set `posts`=`posts`-1  where `id`=?  ", [$post_category]);
                $result3 = $this->Do_Query("update  `posts_category`  set `posts`=`posts`+1  where `id`=?  ", [$category]);
            }
            if ($result == true) {
//  =======  upload img for post ========
                if (isset($file["post_first_img"]) and !empty($file["post_first_img"])) {
                    $file = $file["post_first_img"];
                    $filename = $this->filter($file['name']);
                    $filesize = $this->filter($file['size']);
                    $filetemp = $file['tmp_name'];
                    $filetype = $this->filter($file['type']);
                    $fileerror = $this->filter($file['error']);
                    $uploadok = 0;
					mkdir('public/posts/' . $post_id);
                    $target = 'public/posts/' . $post_id . '/';
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
                        $new_target = $target . "s_" . $newname . '.' . $exe;
                        $this->creat_thumbnail($target2, $new_target, 255, 200);
                        $imgname = $newname . '.' . $exe;
                        $sql = "update `posts` set `img_name`=? WHERE `id`=?";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindValue(1, $imgname);
                        $stmt->bindValue(2, $post_id);
                        $stmt->execute();
                        file_put_contents($target . "post_title.txt", "title => " . $title . "  |  category_id => " . $category);
                    }
                }
                $_SESSION["update_post"] = "success";
                header("location:" . SITE_URL . "admin_posts");
            } else {
                $_SESSION["update_post"] = "danger";
                header("location:" . SITE_URL . "admin_posts/edit_post/" . $post_id);
            }
        } else {
            $_SESSION["update_post"] = "empty";
            header("location:" . SITE_URL . "admin_posts/edit_post/" . $post_id);
        }
    }

    function ajax_upload_img()
    {
        $file = $_FILES["userImage"];

        $filename = $file['name'];
        $filesize = $file['size'];
        $filetemp = $file['tmp_name'];
        $filetype = $file['type'];
        $fileerror = $file['error'];
        $uploadok = 0;

        $target = 'public/posts/upload_images/';
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
            $url = SITE_URL . $target . $newname . '.' . $exe;
            return $url;
//            $sql = "insert into   gallery (`img_name`) VALUES (?)   ";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->bindValue(1, $imgname);
//            $stmt->execute();
        }
    }

}