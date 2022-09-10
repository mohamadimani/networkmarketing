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

$factor_products = $data["factor_products"];
$sum_factor_price = $data["sum_factor_price"];
$user_info = $data["user_info"];
?>

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
        var time = h + ':' + m + ':' + s;
        $('span.datetime').text(time)
    }, 1000);
</script>

<style>
    @media print {

        i.md-menu, div.topbar, .btn-success {
            display: none !important;
        }

    }

    .card-box {
        margin-top: -75px;
    }

    .intro_tbl tr {
        border: none !important;
    }

    .intro_tbl td {
        border: none !important;
        text-align: right;
    }

    .intro_tbl2 tr {
        border: none !important;
    }

    .intro_tbl2 td {
        border: none !important;
        text-align: right;
    }

    img.pay {
        width: 100px !important;
        height: 100px !important;
    }

    ul.print_footer {
        list-style: none;
        width: 100%;
        height: 100px;
        position: relative;
        padding: 10px;
        margin: 10px 0 90px 0;
    }

    ul.print_footer li {
        display: block;
        font-size: 17px;
        font-weight: bold;
        float: right;
        height: 30px;
    }

    table td, table th {
        font-size: 17px !important;
    }

    li.factor_number {
        /*float: left;*/
        /*position: absolute;*/
        /*top: -172px;*/
        /*left: 150px;*/
        /*font-weight: bold;*/
        /*font-size: 18px;*/
    }

    li.datetime {
        /*float: left;*/
        /*position: absolute;*/
        /*top: -210px;*/
        /*left: 100px;*/
        /*font-weight: bold;*/
        /*font-size: 18px;*/
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title m-b-30">پرینت فاکتور </h4>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h3 style="text-align: center;font-weight: bold">
                                <span><?= $site_options["site_name"] ?></span></h3>
                            <div class="row">
                                <ul class=" print_footer">
                                    <li class="factor_number" style="float: right;">
                                        <span class="date">شماره فاکتور :</span>
                                        <span><?= $factor_products[0]["factor_number"] ?></span>
                                    </li>
                                    <li style="text-align: left;float: left;">
                                        <span class="date">تاریخ ثبت سفارش :</span>
                                        <span class="date"><?= $factor_products[0]["date"] ?></span>
                                    </li>
                                    <br>
                                    <br>
                                    <li style="width: 100%;float: right;">
                                        <span>نام خریدار :</span>
                                        <span><?= $user_info["name"] . " " . $user_info["family"] ?></span>
                                    </li>
                                    <li style="width: 100%;float: right;">
                                        <span>تلفن  :</span>
                                        <span><?= $user_info["mobile"] ?></span>
                                    </li>
                                    <li style="width: 100%;float: right;">
                                        <span>آدرس  :</span>
                                        <span><?= $user_info["address"] ?></span>
                                    </li>
                                    <br>
                                    <br>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-actions-bar">
                                    <tbody class="products">
                                    <tr>
                                        <th>محصول</th>
                                        <th>قیمت</th>
                                        <th>تعداد</th>
                                        <th>تخفیف</th>
                                        <th>جمع قیمت</th>
                                    </tr>
                                    <?php foreach ($factor_products as $order) { ?>
                                        <tr>
                                            <td><?= $order["product_name"] ?></td>
                                            <td><span> <?= $order["price"] ?> </span><span> تومان </span></td>
                                            <td><span><?= $order["count"] ?></span></td>
                                            <td><span><?= $order["discount"] ?></span><span>%</span></td>
                                            <td>
                                                <span><?= (($order["price"] - (($order["price"] * $order["discount"]) / 100)) * $order["count"]) ?></span><span> تومان </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <br>
                                <table class=" intro_tbl2 table table-actions-bar">
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>جمع مبلغ فاکتور به حروف :</td>
                                        <td></td>
                                        <td><span><?= $sum_factor_price[1] ?></span><span> تومان </span></td>
                                    </tr>
                                    <tr>
                                        <td> به عدد :</td>
                                        <td></td>
                                        <td><span><?= $sum_factor_price[0] ?></span><span> تومان </span></td>
                                    </tr>
                                    <tr></tr>
                                    <tr style="position: relative">
                                        <td>وضعیت پرداخت :</td>
                                        <td>
                                            <?php if ($factor_products[0]["pay_status"] == "PAID") { ?>
                                                <img class="pay" src="<?= SITE_URL ?>public/images/pay_status/pay.png"
                                                     alt="">
                                            <?php } else if ($factor_products[0]["pay_status"] == "UNPAID") { ?>
                                                <img class="pay" src="<?= SITE_URL ?>public/images/pay_status/unpay.png"
                                                     alt="">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="btn btn-success" onclick="print()"> پرینت </span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <ul>
                            <li class="datetime">
                                <span class="date">زمان پرینت :</span>
                                <span class="datetime"></span> -
                                <span class=""><?= $perdate ?></span>
                            </li>
                        </ul>

                    </div> <!-- end col -->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
