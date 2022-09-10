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

<div class="row">
    <div class="col-sm-8 col-sm-push-3 col-xs-8 col-xs-push-3 ">
        <div class="card-box">

            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>موبایل</th>
                        <th><span class="title_tr">  سابقه کار (سال) :</span></th>
                        <th>تاریخ ثبت نام</th>
                        <th> وضعیت</th>
                        <th>مشاهده</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($resume as $row) {
                    ?>
                    <tr <?php if ($row["status"] == "NEW") {
                        echo "style='background-color:#E9FFB6;'";
                    } ?>>
                        <th><?= $row["name"] ?></th>
                        <th><?= $row["mobile"] ?></th>
                        <th><?= $row["experience_work"] ?></th>
                        <th><?= convert_date($row["register_date"]) ?></th>
                        <th><?php if ($row["status"] == "NEW") { ?>
                                <span style="color: #32cb32">جدید</span>
                            <?php } elseif ($row["status"] == "SEEN") { ?>
                                <span style="color: #343434">دیده شده</span>
                            <?php } ?></th>
                        <th><a href="<?= SITE_URL ?>admin_resume/single_resume/<?= $row["id"] ?>">
                                <span class="fa fa-eye"></span></a></th>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- end col -->
</div>

<div style="margin: 50px 0"></div>
<script>

    function active_user(id, status, item) {
        var url = "<?= SITE_URL ?>admin_users_list/user_status_change";
        var data = {'id': id, 'status': status};
        var act_title = '';
        var act_color = '';
        if (status == 'active') {
            act_title = 'فعال';
            act_color = '#00c300';
        } else if (status == 'inactive') {
            act_title = 'غیر فعال';
            act_color = 'red';
        }
        $.post(url, data, function (msg) {
            if (msg == true) {
                swal('با موفقیت ثبت شد', ' ', 'success');
                $(item).parents('td').find('a.hidden').removeClass('hidden');
                $(item).parents('tr').find('td.act_title').text(act_title);
                $(item).parents('tr').find('td.act_title').css({'color': act_color});
                $(item).addClass('hidden');
            } else {
                swal("مشکل در ثبت !", " ", "error");
            }
        })
    }

    function seen_user(item_id, item) {
        var url = "<?= SITE_URL ?>admin_users_list/save_user_status_change";
        var data = {"user_id": item_id};
        $.post(url, data, function (msg) {
            if (msg == true) {
                swal('با موفقیت ثبت شد', ' ', 'success');
                $(item).parents("tr").find("td.status").text("دیده شده");
                $(item).removeClass("btn btn-success fa fa-check");
                $(item).addClass(" fa fa-eye");
            } else {
                swal("مشکل در ثبت !", " ", "error");
            }
        })
    }

</script>
