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


?>
<!-- Forms -->
<div style="margin-top: 50px"></div>
<div class="row">
    <div class="col-sm-8 col-xs-8 col-sm-push-3 col-xs-push-3">
        <div class="card-box">
            <div class="row">

                <div class="col-md-12">
                    <h4 class="m-t-0 header-title pull-left"><b> مدیریت مشتریان</b></h4>
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
            <div class="row">
                <div class="col-sm-8">
                    <form role="form">
                        <div class="form-group contact-search m-b-30">
                            <input type="text" id="search" class="form-control" placeholder="جستجو...">
                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                        </div> <!-- form-group -->
                    </form>
                </div>
                <div class="col-sm-4">
                    <a href="#custom-modal" class="btn btn-default btn-md waves-effect waves-light m-b-30"
                       data-animation="fadein" data-plugin="custommodal"
                       data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i>افزودن مشتری</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mails m-0 table table-actions-bar">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نوع</th>
                        <th>نام</th>
                        <th>نام کاربری</th>
                        <th> زمان ورود</th>
                        <th> IP</th>
                        <th> عملیات</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $a = 0;
                    foreach ($data['onlines'] as $conline) {
                        $a++ ?>
                        <tr class="active">
                            <td><?= $a ?></td>
                            <td><?php if ($conline['type'] == 'clerk') {
                                    echo 'مدیر';
                                } elseif ($conline['type'] == 'user') {
                                    echo 'مشتری';
                                } elseif ($conline['type'] == 'provider') {
                                    echo 'فروشنده';
                                } ?></td>
                            <td><?= $conline['name'] ?></td>
                            <td><?= $conline['username'] ?></td>
                            <td><?php
                                $time = $conline['login_time'];
                                $year = date('Y', $time);
                                $month = date('m', $time);
                                $day = date('d', $time);
                                $jalali_date = gregorian_to_jalali($year, $month, $day);
                                $year = $jalali_date[0];
                                $month = $jalali_date[1];
                                $day = $jalali_date[2];
                                echo $year . '/' . $month . '/' . $day . ' - ' . date('H:i:s', $time);
                                ?>
                            </td>

                            <td><?= $conline['IP'] ?></td>
                            <td>
                                <a href="#" class="table-action-btn p" title="مشاهده کاربر" style="margin: 0 10px">
                                    <i class="btn btn-info btn-xs md md-search"></i></a>
                                <?php if ($conline['session'] !== $_SESSION['clerk']) {

                                    ?>
                                    <a style="cursor: pointer"
                                       onclick="logout_user(<?= $conline['id'] ?>,this )"
                                       title="خروج کاربر" class="table-action-btn ">
                                        <i class="btn btn-warning btn-xs  md md-close"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- end col -->
</div>

<div style="margin: 50px 0"></div>
<script>

    function logout_user(id, item) {
        var url = "<?= SITE_URL ?>admin_users_list/set_logout_log";
        var data = {'row_id': id};

        $.post(url, data, function (msg) {
            if (msg == true) {
                swal('با موفقیت خارج شد', ' ', 'success');
                $(item).parents('tr').remove();
            } else {
                swal("مشکل در ثبت !", " ", "error");
            }
        })
    }

</script>
