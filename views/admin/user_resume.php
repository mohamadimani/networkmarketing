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

<link rel="stylesheet" href="<?= SITE_URL ?>public\admin\assets\plugins\datepicker/css/persianDatepicker-default.css"/>
<script src="<?= SITE_URL ?>public\admin\assets\plugins\datepicker/js/persianDatepicker.js"></script>


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
            if (!empty($_SESSION["save_resume"]) and $_SESSION["save_resume"] == "success") {
                ?>
                <div class="alert alert-success alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link">اطلاعات شما با موفقیت ذخیره شد</a>
                </div>
            <?php }
            if (!empty($_SESSION["save_resume"]) and $_SESSION["save_resume"] == "danger") {
                ?>
                <div class="alert alert-danger alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link">مشکل در ذخیره اطلاعات !</a>
                </div>
            <?php }
            if (!empty($_SESSION["save_resume"]) and $_SESSION["save_resume"] == "empty") {
                ?>
                <div class="alert alert-warning alert-dismissable text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×
                    </button>
                    <a class="alert-link"> لطفا برای شناخت بهتر شما اطلاعات رو کامل پر کنید !</a>
                </div>
            <?php }
            unset($_SESSION["save_resume"]);
            ?>

            <div class="table-responsive">
                <form action="<?= SITE_URL ?>userresume/save_resume" method="post"
                      onsubmit="$('.submit_btn1').css({'display':'none'}),$('i.loading_bottom').css({'display':'inline'})">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                        <tr>
                            <th><a href="<?= SITE_URL ?>"><span class="btn btn-info"> بازگشت به صفحه سایت </span></a>
                            </th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">نام و نام خانوادگی :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="name"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">تاریخ تولد :</span></th>
                            <th><input required class="form-control usage  input-sm" type="text" name="bird"></th>
                        </tr>
                        <script>
                            $(".usage").persianDatepicker();
                        </script>
                        <tr>
                            <th><span class="title_tr">شماره شناسنامه :</span></th>
                            <th><input required class="form-control  input-sm" type="number" name="ID_number"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  ایمیل :</span></th>
                            <th><input required class="form-control  input-sm" type="email" name="email"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  آدرس :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="address"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">موبایل :</span></th>
                            <th><input required class="form-control  input-sm" type="tel" name="mobile"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  تاهل :</span></th>
                            <th>
                                <label for="y_marrid">متاهل</label>
                                <input required class=" " id="y_marrid" name="marrid" value="yes" type="radio">
                                <label for="n_marrid">مجرد</label>
                                <input required class=" " id="n_marrid" name="marrid" value="no" type="radio">
                            </th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  رشته :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="major"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  مدرک تحصیلی :</span></th>
                            <th><input required class="form-control  input-sm" type="text" name="evidence"></th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  جنسیت :</span></th>
                            <th>
                                <label for="m_sex" style="margin-right:10px!important; ">آقا</label>
                                <input required class="   " id="m_sex" name="sex" value="mail" type="radio">
                                <label for="f_sex" style="margin-right:10px!important; "> خانم</label>
                                <input required class="    " id="f_sex" name="sex" value="femail" type="radio">
                            </th>
                        </tr>
                        <tr>
                            <th><span class="title_tr">  سابقه کار (سال) :</span></th>
                            <th><input required class="form-control  input-sm" type="number" name="experience_work">
                            </th>
                        </tr>
                        <tr>
                            <th><span class="title_tr"> توانایی ها :</span></th>
                            <th><textarea class="form-control  input-sm" name="comment" required
                                          placeholder="توضیحاتی در مورد توانایی های خود بنویسید"></textarea></th>
                        </tr>

                        <tr>
                            <th><span class="title_tr"><?= $data["captcha"]; ?></span></th>
                            <th><input required class="form-control  input-sm" type="number" name="captcha"></th>
                        </tr>
                        <tr>
                            <th>
                                <input type="submit" value="ثبت" class="btn btn-success submit_btn1 ">
                                <i class=" btn btn-success loading_bottom fa fa-spin fa-spinner "
                                   style="font-size: 20px!important;display: none"></i>
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


