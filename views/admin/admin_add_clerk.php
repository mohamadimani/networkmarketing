<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 02/02/2019
 * Time: 10:56 AM
 */


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

date_default_timezone_set("Asia/tehran");
$year = date('Y', time());
$month = date('m', time());
$day = date('d', time());
$time = date('h:i:s', time());
$perdate = gregorian_to_jalali($year, $month, $day);
$perdate = $perdate[0] . '/' . $perdate[1] . '/' . $perdate[2];

function convert_date($data = "")
{
    $time = strtotime($data);
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
    $jalali_date = gregorian_to_jalali($year, $month, $day);

    $year = $jalali_date[0];
    $month = $jalali_date[1];
    $day = $jalali_date[2];
    return $year . '/' . $month . '/' . $day;
}

?>


<!-- Forms -->
<div style="margin-top: 50px"></div>


<style>
    span.title_tr {
        text-align: right;
        float: right;
    }

    #y_marrid, #n_marrid, #m_sex, #f_sex {
        margin: 1px 5px;
    }
</style>
<div class="row">
    <div class="col-sm-6 col-sm-push-3 col-xs-12 col-xs-push-0 ">
        <div class="card-box">

            <?php
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "success") {
                ?>
                <div class="alert alert-success alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> کاربر جدید با موفقیت ذخیره شد</a>
                </div>
            <?php }
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "danger") {
                ?>
                <div class="alert alert-danger alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link">مشکل در ذخیره اطلاعات !</a>
                </div>
            <?php }
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "empty") {
                ?>
                <div class="alert alert-warning alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> لطفا اطلاعات رو کامل پر کنید !</a>
                </div>
            <?php }
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "captcha") {
                ?>
                <div class="alert alert-warning alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> کد امنیتی رو اشتباه وارد کردید !</a>
                </div>
            <?php }
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "re_pass") {
                ?>
                <div class="alert alert-warning alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> رمز عبور و تکرار رمز عبور یکسان نیستند !</a>
                </div>
            <?php }
            if (!empty($_SESSION["add_clerk"]) and $_SESSION["add_clerk"] == "is_clerk") {
                ?>
                <div class="alert alert-warning alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> این نام کاربری قبلا استفاده شده !</a>
                </div>
            <?php }
            unset($_SESSION["add_clerk"]);
            ?>

            <div class="table-responsive">
                <form action="<?= SITE_URL ?>admin_add_user/save_user" method="post">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                        <tr>
                            <th><span class="title_tr">نام :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="name"></th>
                        </tr>

                        <tr>
                            <th><span class="title_tr">موبایل :</span></th>
                            <th><input required class="form-control  input-sm" type="tel" name="mobile"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  نام کاربری :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="username"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">    رمز ورود :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="password"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">     تکرار رمز ورود :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="re_password">
                            </th>
                        </tr>
                        <tr>
                            <th><span class="title_tr"><?= $data["captcha"]; ?></span></th>
                            <th><input required class="form-control  input-sm" type="number" name="captcha"></th>
                        </tr>
                        <tr>
                            <th>
                                <input type="submit" value="ثبت" class="btn btn-success">
                                <input type="reset" value="خالی کردن فرم  " class="btn btn-warning">
                            </th>
                        </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>

<div style="margin: 50px 0"></div>


