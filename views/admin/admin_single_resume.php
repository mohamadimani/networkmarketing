<?php
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

$resume = $data["resume"];


?>


<!-- Forms -->
<div style="margin-top: 50px"></div>
<div class="row">
    <div class="col-sm-8 col-xs-8 col-sm-push-3 col-xs-push-3">
        <div class="card-box">
            <div class="row">

                <div class="col-md-12">
                    <h4 class="m-t-0 header-title pull-left"><b> مدیریت ثبت نام های همکاری</b></h4>
                    <span class=" text-muted m-b-30 font-13 pull-right">
                        <?= $perdate ?> <br>
                        <span class="datetime"> <?= $time ?></span>
                    </span>
                    <script>
                        setInterval(function () {
                            var time1 = new Date();
                            var h = time1.getHours();
                            var m = time1.getMinutes();
                            var s = time1.getSeconds();
                            if (h < 10) {
                                h = "0" + h
                            }
                            if (m < 10) {
                                m = "0" + m
                            }
                            if (s < 10) {
                                s = "0" + s
                            }
                            var tim = h + ':' + m + ':' + s;
                            $('span.datetime').text(tim)
                        }, 1000);
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    span.title_tr {
        text-align: right;
        float: right;
    }
</style>
<div class="row">
    <div class="col-sm-8 col-sm-push-3 col-xs-8 col-xs-push-3 ">
        <div class="card-box">

            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
                    <tr>
                        <th><span class="title_tr">نام :</span></th>
                        <th><?= $resume["name"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">تاریخ تولد :</span></th>
                        <th><?= $resume["bird_date"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">شماره شناسنامه :</span></th>
                        <th><?= $resume["ID_number"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  ایمیل :</span></th>
                        <th><?= $resume["email"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  آدرس :</span></th>
                        <th><?= $resume["address"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  تاهل :</span></th>
                        <th><?php
                            if ($resume["marrid"] == "NO") {
                                echo "مجرد";
                            } else if ($resume["marrid"] == "YES") {
                                echo "متاهل";
                            }
                            ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  رشته :</span></th>
                        <th><?= $resume["major"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  مدرک تحصیلی :</span></th>
                        <th><?= $resume["evidence"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  جنسیت :</span></th>
                        <th><?php
                            if ($resume["sex"] == "MAIL") {
                                echo "آقا";
                            } else if ($resume["sex"] == "FEMAIL") {
                                echo "خانم";
                            }
                            ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">  سابقه کار (سال) :</span></th>
                        <th><?= $resume["experience_work"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr">موبایل :</span></th>
                        <th><?= $resume["mobile"] ?></th>
                    </tr>
                    <tr>
                        <th><span class="title_tr"> توضیحات :</span></th>
                        <th><?= $resume["comment"] ?></th>
                    </tr>
                    <tr>
                        <th style="width: 200px;"><span class="title_tr">تاریخ ثبت نام :</span></th>
                        <th> <?= convert_date($resume["register_date"]) ?></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!-- end col -->
</div>

<div style="margin: 50px 0"></div>
<script>

    resume_view(<?= $resume["id"] ?>);
    function resume_view(resume_id) {
        var url = "<?= SITE_URL ?>admin_resume/update_resume_status";
        var data = {"resume_id": resume_id};
        $.post(url, data, function (msg) {
//            alert(msg);
        })

    }

</script>
