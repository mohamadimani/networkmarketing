<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_userresume extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_captcha()
    {
        $captcha = $this->captcha_cod();
        $captcha_question = $captcha["question"];
        $_SESSION["captcha_answer"] = $captcha["answer"];
        return $captcha_question;
    }

    function save_resume($data = "")
    {
        $name = $this->filter($data["name"]);
        $bird = $this->filter($data["bird"]);
        $ID_number = $this->filter($data["ID_number"]);
        $email = $this->filter($data["email"]);
        $address = $this->filter($data["address"]);
        $marrid1 = $this->filter($data["marrid"]);
        if ($marrid1 == "yes") {
            $marrid = "YES";
        } elseif ($marrid1 == "no") {
            $marrid = "NO";
        }
        $major = $this->filter($data["major"]);
        $evidence = $this->filter($data["evidence"]);
        $sex1 = $this->filter($data["sex"]);
        if ($sex1 == "mail") {
            $sex = "MAIL";
            $sex2 = "آقای $name";

        } elseif ($sex1 == "femail") {
            $sex = "FEMAIL";
            $sex2 = "خانم $name";
        }
        $experience_work = $this->filter($data["experience_work"]);
        $mobile = $this->filter($data["mobile"]);
        $comment = $this->filter($data["comment"]);
        $captcha = $this->filter($data["captcha"]);

        if (!empty($name) and !empty($mobile) and !empty($comment) and !empty($address) and !empty($captcha) and trim($captcha) == trim($_SESSION["captcha_answer"])) {
            $result = $this->Do_Query("insert into `resume`(`name`,`bird_date`, `ID_number`,`email`,`address`,`marrid`,`major`,`evidence`,`sex`,`experience_work`,`mobile`,`comment`,`status` )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,'NEW') ", [$name, $bird, $ID_number, $email, $address, $marrid, $major, $evidence, $sex, $experience_work, $mobile, $comment]);
            if ($result == true) {
                $_SESSION["save_resume"] = "success";
//                send for user
                $text1 = "$sex2 رزومه شما با موفقیت ارسال شد www.imtit.com";
                $user_number = $mobile;
                $this->send_sms($user_number, $text1);

//                    send for admin
                $text2 = "$sex2 در سایت رزومه خود را تکمیل کرده است";
                $phone_number = "09124825249";
//                $phone_number = "09191930406";
                $this->send_sms($phone_number, $text2);
                header("location:" . SITE_URL . "userresume");
            } else {
                $_SESSION["save_resume"] = "danger";
                header("location:" . SITE_URL . "userresume");
            }
        } else {
            $_SESSION["save_resume"] = "empty";
            header("location:" . SITE_URL . "userresume");
        }


    }


}


