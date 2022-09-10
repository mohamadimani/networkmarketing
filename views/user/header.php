<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="<?= SITE_URL ?>public\users\dashboard/dashboard-css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>public\users\dashboard/dashboard-css/style.css">
    <link rel="shortcut icon" href="<?= SITE_URL ?>public/web/images/favicon.png">
    <!-- favicon -->
    <link rel="icon" href="favicon.ico">
    <title>imt shop</title>
    <link href="<?= SITE_URL ?>public/admin/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/css/vendor/tooltipster.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/css/vendor/owl.carousel.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/css/style.css">
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/css/vendor/magnific-popup.css">
    <!-- jQuery -->
    <script src="<?= SITE_URL ?>public/ecomm/js/vendor/jquery-3.1.0.min.js"></script>
    <!-- favicon -->
    <!--    bootstrap-->
    <link href="<?= SITE_URL ?>public/admin/assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css">
    <script src="<?= SITE_URL ?>public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
</head>
<body>
<!-- SIDE MENU -->
<div id="dashboard-options-menu" class="side-menu dashboard left closed">
    <!-- SVG PLUS -->
    <svg class="svg-plus">
        <use xlink:href="#svg-plus"></use>
    </svg>
    <div class="side-menu-header">
        <!-- USER QUICKVIEW -->
        <div class="user-quickview">
            <!-- USER AVATAR -->
            <a href="<?= SITE_URL ?>users">
                <div class="outer-ring">
                    <div class="inner-ring"></div>
                    <figure class="user-avatar">
                        <img src="<?= SITE_URL ?>public/ecomm/dashboard-images/avatars/avatar_09.jpg" alt="avatar">
                    </figure>
                </div>
            </a>
            <p class="user-name" style="color: #f0d797;"><?= $user_info["name"]." ".$user_info["family"] ?></p>
            <!-- /USER INFORMATION -->
        </div>
        <!-- /USER QUICKVIEW -->
    </div>
    <p class="side-menu-title">حساب کاربری</p>
    <ul class="dropdown dark hover-effect interactive">

        <li class="dropdown-item ">
            <a href="<?= SITE_URL ?>">
                <span class="sl-icon icon-settings"></span>
                صفحه اصلی
            </a>
        </li>
        <li class="dropdown-item ">
            <a href="<?= SITE_URL ?>ecomm">
                <span class="sl-icon icon-settings"></span>
فروشگاه
            </a>
        </li>
        <li class="dropdown-item">
            <a href="<?= SITE_URL ?>ecomm/basket">
                <span class="sl-icon icon-tag"></span>
                  سبد خرید شما </a>
        </li>
        <li class="dropdown-item">
            <a href="<?= SITE_URL ?>users/orders">
                <span class="sl-icon icon-tag"></span>
                خرید های شما </a>
        </li>
        <li class="dropdown-item">
            <a href="<?= SITE_URL ?>users/favorites">
                <span class="sl-icon icon-tag"></span>
                    محصولات مورد علاقه </a>
        </li>
        <li class="dropdown-item ">
            <a href="<?= SITE_URL ?>users">
                <span class="sl-icon icon-settings"></span>
                تنظیمات اکانت
            </a>
        </li>
    </ul>
    <a href="<?= SITE_URL ?>users/user_logout" class="button small secondary">خروج از مدیریت</a>
</div>

<div class="dashboard-body">
    <div class="dashboard-header retracted">
        <div class="dashboard-header-item title">
            <!-- DB SIDE MENU HANDLER -->
            <div class="db-side-menu-handler">
                <img src="<?= SITE_URL ?>public/users/dashboard/dashboard-images/dashboard/db-list-left.png"
                     alt="db-list-left">
            </div>
            <h6 style="direction: rtl"><span>محدودیت پنل : </span><span class="active_time"></span></h6>
        </div>
    </div>

    <script>
        var counter = 0;
        setInterval(function () {
            var nowtime = Math.abs(Math.floor(new Date() / 1000));
            var left =  <?= $_SESSION["user_login_time"] ?> -nowtime;
            if (nowtime <= <?= $_SESSION["user_login_time"]  ?>) {
                var min = Math.floor(left / 60);
                var secend = Math.floor(left - (min * 60));
                if (min < 2) {
                    $('span.active_time').css({
                        'color': "red",
                        "font-weight": "bold",
                        "font-size": "16px"
                    });
                    if (counter == 0) {
                        swal("اخطار !", min + "دقیقه و " + secend + "ثانیه " + " تا بسته شدن پنل مدیر جهت بالا بردن امنیت !", "error");
                        counter++;
                    }
                }
                if (min < 10) {
                    min = "0" + min
                }
                if (secend < 10) {
                    secend = "0" + secend
                }
                var time = min + ':' + secend;
                $('span.active_time').text(time);
            }
        }, 1000);
    </script>
