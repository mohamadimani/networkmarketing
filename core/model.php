<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 10:16 PM
 */
class model
{
    public $conn;

    ////  ==== for test ====
    function state_list2()
    {
        $city = '{
	"request": {
		"ID": 7259,
		"from": "admin",
		"api": "listState",
		"date": "2018-07-16 15:18:13",
		"ip": "178.131.35.119",
		"member": {
			"mobile": "09122545391",
			"name": "علی امیرنژاد",
			"session": "OylZ6LpU3YsAIq8wuxKRE7ifBtTznC1eJMQrPboS"
		}
	},
	"status": "ok",
	"count": 2,
	"list": [
		{
			"ID": "KZ",
			"title": "خوزستان"
		},
		{
			"ID": "KZ2",
			"title": "2خوزستان"
		}
	]
}';
        return json_decode($city, true);
    }

    function city_list2()
    {
        $city = '{"request": {"ID": 4393,
    		"from": "admin",
    		"api": "dataCity",
    		"date": "2018-07-14 20:13:59",
    		"ip": "192.168.10.90",
    		"member": {
    			"mobile": "09122545391",
    			"name": "علی امیرنژاد",
    			"session": "OylZ6LpU3YsAIq8wuxKRE7ifBtTznC1eJMQrPboS"
    		}
    	},
    	"status": "ok",
    	"city": [
    		{
    			"ID": "AVZ",
    			"title": "اهواز"
    		},
    		{
    			"ID": "AVZ2",
    			"title": "اهواز2"
    		}
    	]
    }';
        return json_decode($city, true);
    }

    ////  ==== for test ====
    function __construct()
    {
//        $this->settings = parse_ini_file("db_info.ini2.php");
        $this->settings = parse_ini_file("db_info.ini.php");
        $utf = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $this->conn = new PDO("mysql:host=" . $this->settings['host'] . ";dbname=" . $this->settings['dbname'], $this->settings['user'], $this->settings['password'], $utf);
//        $this->set_function_log('connect_db');
    }

    function user_all_access($access = "all")
    {
        $all_access = [];
        if (isset($_SESSION['clerk_id'])) {
            $clerk_id = base64_decode($_SESSION['clerk_id']);
            $clerk_id = $this->filter($clerk_id);
        }
        $controlle = $this->filter($access);
//            check for admin access all
        $sql = ("select * from `user_access` WHERE `user_id`=? and `access`=? ");
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $clerk_id);
        $stmt->bindParam(2, $controlle);
        $stmt->execute();
        $access_result_admin = $stmt->fetch(2);
        if (!empty($access_result_admin["access"]) and $access_result_admin["access"] == "all") {
            return "all";
        } else {
            $sql = ("select `access` from `user_access` WHERE `user_id`=?  ");
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $clerk_id);
            $stmt->execute();
            $access_result = $stmt->fetchall(2);
            foreach ($access_result as $row_access) {
                $all_access[] = $row_access["access"];
            }
            return $all_access;
        }
    }

    function check_access($controlle = "", $access = "all")
    {
        $control_name = strpos($controlle, "admin");
        if (empty($control_name) and !is_numeric($control_name)) {
            return true;
        } else {
            if ($controlle == "admin_login") {
                return true;
            } else if (!isset($_COOKIE['clerk']) or !isset($_SESSION['clerk']) or $_COOKIE['clerk'] != $_SESSION['clerk']) {
                header("location:" . SITE_URL . "admin_login");
            } else {
                if (isset($_SESSION['clerk_id'])) {
                    $clerk_id = base64_decode($_SESSION['clerk_id']);
                    $clerk_id = $this->filter($clerk_id);

                    $controlle = $this->filter($controlle);
//            check for admin access all
                    $sql = ("select * from `user_access` WHERE `user_id`=? and `access`=? ");
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(1, $clerk_id);
                    $stmt->bindParam(2, $access);
                    $stmt->execute();
                    $access_result_admin = $stmt->fetch(2);

                    if (!empty($access_result_admin["access"]) and $access_result_admin["access"] == "all") {
                        return true;
                    } else {

                        $sql = ("select * from `user_access` WHERE `user_id`=? and `access`=? ");
                        $stmt = $this->conn->prepare($sql);
                        $stmt->bindParam(1, $clerk_id);
                        $stmt->bindParam(2, $controlle);
                        $stmt->execute();
                        $access_result_admin2 = $stmt->fetch(2);

                        if (!empty($access_result_admin2["access"]) and is_array($access_result_admin2)) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    function show_new_comments()
    {
        $sql = "select count(status) as `count` from `comments` where `status`='NEW'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(2);
        return $result;
    }

    function show_new_employ()
    {
        $sql = "select count(status) as `count` from `idea_room_employ` where `status`='NEW'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(2);
        return $result;
    }

    function show_new_resume()
    {
        $sql = "select count(status) as `count` from `resume` where `status`='NEW'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(2);
        return $result;
    }

    function Do_Select($sql = '', $param = [], $fetch = '')
    {
        $stmt = $this->conn->prepare($sql);
        if (!empty($param)) {
            foreach ($param as $key => $value) {
                $stmt->bindvalue($key + 1, $value);
            }
        }
        $stmt->execute();
        if (empty($fetch)) {
            $result = $stmt->fetchAll(2);
        } else {
            $result = $stmt->fetch(2);
        }
        return $result;
    }

    function Do_Query($sql = '', $values = [])
    {
        $stmt = $this->conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function filter($data)
    {
        $data = trim(htmlspecialchars(stripcslashes($data)));
        return $data;
    }

    function ip()
    {
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $this->filter($_SERVER['HTTP_X_REAL_IP']);
        } //last requester

        elseif (!empty($_SERVER['HTTP_CLIENT-IP']))//internet sharing center
            $ip = $this->filter($_SERVER['HTTP_CLIENT-IP']);
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))//check for proxies
            $ip = $this->filter($_SERVER['HTTP_X_FORWARDED_FOR']);
        else {
            $ip = $this->filter($_SERVER['REMOTE_ADDR']);//if there's not a proxy
        }
        return $ip;
    }

    function set_function_log($function_name = '')
    {
        $function_name = $this->filter($function_name);
        $function_issset = $this->Do_Select("select * from function_log where function_name=?", [$function_name]);
        if (!empty($function_issset)) {
            $this->Do_Query("update function_log set `count`=`count`+1 WHERE `function_name`=?", [$function_name]);
        } else if (empty($function_issset)) {
            $this->Do_Query("insert into `function_log` (`function_name`,`count`) VALUES (?,'1')", [$function_name]);
        }
    }

    function check_login()
    {
        $this->set_function_log($function_name = 'check_login');

        $users_online = $this->Do_Select('select `id`,`login_time`,`time_out` from `onlines` where `online`=?', ['on']);
        foreach ($users_online as $user_online) {
            if ((time() - $user_online['time_out']) > $user_online['login_time']) {
                $this->Do_Query("update `onlines` set `online`='off' WHERE `id`=?", [$user_online['id']]);
            }
        }
    }

    function session_set($type = '', $value = '')
    {

    }

    function str_cod($len = '20')
    {
        $str_cod = str_split('ABCDEFGHAJKLMNOPQRSTUVWXYZ1234567890');
        shuffle($str_cod);
        $str_cod = array_slice($str_cod, 0, $len);
        $str_cod = implode('', $str_cod);
        return $str_cod;
    }

    function session_check()
    {
        if (isset($_SESSION['clerk'])) {
            $clerk_session = $this->filter($_SESSION['clerk']);
            $onlines_info = $this->Do_Select(" select `id` from `onlines` where `type`='clerk' and `session`=? and `online`='on' ", [$clerk_session], 1);
            if (empty($onlines_info)) {
                unset($_SESSION['clerk']);
                setcookie("clerk", ' ', time() + 1, "/");
                header("location:" . SITE_URL . "admin_login");
            }
        }
        if (isset($_SESSION['user'])) {
            $user_session = $this->filter($_SESSION['user']);
            $onlines_info = $this->Do_Select(" select `id` from `onlines` where `type`='user' and `session`=? and `online`='on' ", [$user_session], 1);
            if (empty($onlines_info)) {
                unset($_SESSION['user']);
                unset($_SESSION['user_id']);
                unset($_SESSION['user_sex']);
                setcookie("user", ' ', time() + 1, "/");
                header("location:" . SITE_URL . "users/user_login");
            }
        }
    }

    function password_hash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    }

    function password_verify($password = '', $password_hash = '')
    {
        if (password_verify($password, $password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    function time_to_jalali_date($date = 'D')
    {
//    option    $date='D','T','DT';

        date_default_timezone_set("Asia/tehran");
        $year = date('Y', time());
        $month = date('m', time());
        $day = date('d', time());
        $time = date('h:i:s', time());
        $perdate = $this->gregorian_to_jalali($year, $month, $day);
        $perdate = $perdate[0] . '/' . $perdate[1] . '/' . $perdate[2];
        if ($date == 'D') {
            return $perdate;
        } else if ($date == 'T') {
            return $time;
        } else if ($date == 'DT') {
            return ['date' => $perdate, 'time' => $time];
        } else if ($date == 'T') {
            return ['time' => $time];
        }

    }

    function gregorian_to_jalali($gy, $gm, $gd, $mod = '')
    {
        $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy += 33 * ((int)($days / 12053));
        $days %= 12053;
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $jm = ($days < 186) ? 1 + (int)($days / 31) : 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));
        return ($mod == '') ? array($jy, $jm, $jd) : $jy . $mod . $jm . $mod . $jd;
    }

//    convert send date to persian date
    function convert_date($data = "")
    {
        if (!empty($data)) {
            $date = $data;
            $time = strtotime($date);
        } else if (empty($data)) {
            $time = time();
        }

        $year = date('Y', $time);
        $month = date('m', $time);
        $day = date('d', $time);
        $jalali_date = $this->gregorian_to_jalali($year, $month, $day);

        $year = $jalali_date[0];
        $month = $jalali_date[1];
        $day = $jalali_date[2];
        return $year . '/' . $month . '/' . $day;
    }

    function API($url = '', $data = '')
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data)
        ));
        $contents = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        return [$contents, $error];
    }

//    select some text from string
    function sub_text($text = '', $char = '', $dot = "")
    {
        $title = $text;
        $title = mb_substr($title, 0, $char);
        $dotstree = "";
        if (mb_strlen($title) < $char) {
            $dotstree = "";
        } else if (!empty($dot)) {
            $dotstree = "...";
        }
        return $title . $dotstree;
    }

    function zarinpalRequest($Amount = '', $Description = '', $Email = '', $Mobile = '')
    {
        require('public/nosoap/nusoap.php');
        $client = new nusoap_client(zarinpalWebAdress, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $params = array(
            'MerchantID' => zarinpalMerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            'Email' => $Email,
            'Mobile' => $Mobile,
            'CallbackURL' => callbackURL
        );
        $result = $client->call('PaymentRequest', $params);
        $Status = $result['Status'];
        $ErrorsArray = unserialize(zarinpalErrors);
        $Authority = '';
        $Error = '';
        if ($Status == 100) {
            $Authority = $result['Authority'];
            $Error = $ErrorsArray[$Status];
        } else {
            if (!empty($ErrorsArray[$Status]))
                $Error = $ErrorsArray[$Status];
        }
        $array = array('Status' => $Status, 'Authority' => $Authority, 'Error' => $Error);
        return $array;
    }

    function zarinpalVerify($Amount = '', $Authority = '')
    {
        require('public/nosoap/nusoap.php');
        $client = new nusoap_client(zarinpalWebAdress, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $result = $client->call('PaymentVerification', array(
            'MerchantID' => zarinpalMerchantID,
            'Amount' => $Amount,
            'Authority' => $Authority
        ));
        $Status = $result['Status'];
        $Error = '';
        $RefID = '';
        $ErrorsArray = unserialize(zarinpalErrors);
        if ($Status == 100) {
            $RefID = $result['RefID'];
            $Error = $ErrorsArray[$Status];
        } else {
            if (!empty($ErrorsArray[$Status]))
                $Error = $ErrorsArray[$Status];
        }
        $array = array('Status' => $Status, 'Error' => $Error, 'RefID' => $RefID);
        return $array;
    }

//   =======   SITE OPTIPNS ========
    function get_options()
    {
        $sql = ("select * from `options` WHERE `status`='ACTIVE'  ");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $options = $stmt->fetchAll(2);
        $push_options = [];
        foreach ($options as $option) {
            $push_options[$option["EN_name"]] = $option["value"];
        }
        return $push_options;
    }

    function get_bout_us()
    {
        $options = $this->Do_Select("select `posts_category`.`id` as `category_id`  , `posts`.* from `posts_category` LEFT JOIN `posts` ON  `posts_category`.`id`=`posts`.`category` WHERE `posts_category`.`EN_name`='about_us'  AND `posts`.`status`='ACTIVE' ", [], 1);
        return $options;
    }

    function get_social()
    {
        $options = $this->Do_Select("select * from `social` WHERE  `status`='ACTIVE' ", []);
        return $options;
    }

    function get_services()
    {
        $options = $this->Do_Select("select `posts_category`.`name` as `category_name`  , `posts`.* from `posts_category` LEFT JOIN `posts` ON  `posts_category`.`id`=`posts`.`category` WHERE `posts_category`.`EN_name`='services'  AND `posts`.`status`='ACTIVE'  ORDER by  `posts`.`id` ASC   LIMIT  0 , 6  ", []);
        return $options;
    }

//    set_pages seen log
    function seen_pages($page_name = "")
    {
        $ip = $this->ip();
        $page_name = $this->filter($page_name);
        $today = strtotime('today midnight');
        $today = $this->filter($today);
        $is_ip = $this->Do_Select("select * from `page_views_log` WHERE  `view_date`>=$today and `user_ip`=? and `page_name`='$page_name'  ", [$ip], 1);
        if (!empty($is_ip["id"])) {
            $date = $is_ip["view_date"] - strtotime('today midnight');
            if ($date < 86400 and $date > 0) {
                $this->Do_Query("UPDATE `page_views_log` SET `views` = `views`+1 ,`view_date`=? WHERE `page_views_log`.`page_name` = ? and `user_ip`=? and `view_date`>=$today", [time(), $page_name, $ip]);
//                echo 'today';
            } else {
                $this->Do_Query("insert into `page_views_log`(`page_name`,`views`,`user_ip`,`view_date`) VALUES (?,1, ?,?)", [$page_name, $ip, time()]);
//                echo 'yesterday';
            }
        } elseif (empty($is_ip["id"])) {
            $this->Do_Query("insert into `page_views_log`(`page_name`,`views`,`user_ip`,`view_date`) VALUES (?,1, ?,?)", [$page_name, $ip, time()]);
        }
    }

    function getNumberTitle($number)
    {
        $and = " و ";
        $p01 = array("صفر", "یک", "دو", "سه", "چهار", "پنج", "شش", "هفت", "هشت", "نه", "ده", "یازده", "دوازده", "سیزده", "چهارده", "پانزده", "شانزده", "هفده", "هجده", "نوزده", "بیست");
        $p02 = array("", "ده", "بیست", "سی", "چهل", "پنجاه", "شصت", "هفتاد", "هشتاد", "نود");
        $p03 = array("", "صد", "دویست", "سیصد", "چهارصد", "پانصد", "ششصد", "هفتصد", "هشتصد", "نهصد");
        $p04 = array("", "هزار", "میلیون", "میلیارد", "هزار میلیارد");
        if (!$number) return $p01[0];
        $number = (string)$number;
        if (strlen($number) > 15) return $number;
        while ((strlen($number) % 3) != 0) $number = "0" . $number;
        $parts = array_reverse(str_split($number, 3));
        $value = "";
        for ($p = 0; $p < count($parts); $p++) {
            $val = "";
            $num = ((int)$parts[$p]);
            if ($num >= 100) {
                $val .= $p03[((int)($num / 100))];
                $num -= ((int)($num / 100)) * 100;
                if ($num > 0) $val .= $and;
            }
            if ($num != 0) {
                if ($num > 20) {
                    $val .= $p02[((int)($num / 10))];
                    $num -= ((int)($num / 10)) * 10;
                    if ($num > 0) $val .= $and . $p01[$num];
                } else $val .= $p01[$num];
            }
            if ($val != "") {
                if ($value != "") $value = $and . $value;
                $value = $val . " " . $p04[$p] . $value;
            }
        }
        return $value;
    }

    function captcha_cod()
    {
        $f_number = rand(6, 11);
        $last_number = rand(1, 5);
        $pro = rand(0, 2);
        $p = ["به اضافه", "منهای", "ضرب در"];

        $f_number_str = $this->getNumberTitle($f_number);
        $last_number_str = $this->getNumberTitle($last_number);
        $cap_question = " حاصل " . $f_number_str . " " . $p[$pro] . " " . $last_number_str . " = ؟";
        $cap_answer = 0;
        switch ($p[$pro]) {
            case "منهای":
                $cap_answer = $f_number - $last_number;
                break;
            case "به اضافه":
                $cap_answer = $f_number + $last_number;
                break;
            case "ضرب در":
                $cap_answer = $f_number * $last_number;
                break;
            case "تقسیم بر":
                $cap_answer = round($f_number / $last_number);
                break;
        }
        return ["question" => $cap_question, "answer" => $cap_answer];
    }

    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        $this->rrmdir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function creat_thumbnail($file, $pathtosave = '', $w = "", $h = '', $crop = FALSE)
    {
        $new_height = $h;
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
//        $file_name = 'thumb_' . basename($file);
//        $ese=pathinfo($file_name,PATHINFO_EXTENSION);
        $what = getimagesize($file);
        switch (strtolower($what['mime'])) {
            case 'image/png':
                $src = imagecreatefrompng($file);
                break;
            case 'image/jpeg';
                $src = imagecreatefromjpeg($file);
                break;
            case 'image/gif';
                $src = imagecreatefromgif($file);
                break;
            default;
        }

        if ($new_height != '') {
            $newheight = $new_height;
        }
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagejpeg($dst, $pathtosave, 95);
        return $dst;
    }

    function send_sms($number = "", $text = "")
    {
        $url = "37.130.202.188/services.jspd";
        $rcpt_nm = array($number);
        $param = array
        (
            'uname' => 'drm',
            'pass' => '124825249',
            'from' => '100020400',
//            'from' => '5000125475',
            'message' => trim($text),
            'to' => json_encode($rcpt_nm),
            'op' => 'send'
        );
        $handler = curl_init($url);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        $response2 = curl_exec($handler);
        $response2 = json_decode($response2);
        $res_code = $response2[0];
        $res_data = $response2[1];
    }

}

