<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_options extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_options()
    {
        $site_options = $this->Do_Select("select * from  options", []);
        return $site_options;
    }

    function save_options($data = [], $file = [])
    {


        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (!empty($value)) {
                    $value = $this->filter($value);

                    $sql = "update options set `value`=? WHERE `EN_name`=?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindValue(1, $value);
                    $stmt->bindValue(2, $key);
                    $stmt->execute();
                }
            }

// ================  upload site logo ==================
            if (!empty($file["site_logo"]["name"]) and $file["site_logo"]["size"] > 0) {
                $file = $file["site_logo"];
                $filename = $this->filter($file['name']);
                $filesize = $this->filter($file['size']);
                $filetemp = $file['tmp_name'];
                $filetype = $this->filter($file['type']);
                $fileerror = $this->filter($file['error']);
                $uploadok = 0;


                $target = 'public/images/';
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
                    $sql = "update   options set   `value`=? where `EN_name`='site_logo' ";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindValue(1, $imgname);
                    $stmt->execute();
                }
            }
            header("location:".SITE_URL."admin_options");
        } else {
            header("location:" . SITE_URL . "admin_options/F");
        }


    }


}