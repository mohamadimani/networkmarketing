<?php

$model = new model();

function intFormat($num)
{
    settype($num, "String");
    $n = strlen($num);
    $i = 0;
    $help = $n % 3;
    while ($help != 0) {
        $num = '0' . $num;
        $i++;
        $n = strlen($num);
        $help = $n % 3;
    }
    $arr = str_split($num, 3);
    $str = "";
    foreach ($arr as $index) {
        $str = $str . "," . $index;
    }
    $i++;
    return substr($str, $i);
}

if (!empty($_SESSION["admin_login_time"]) and $_SESSION["admin_login_time"] > time()) {
    $login_time_limit = $_SESSION["admin_login_time"] - time();
    $login_time_limit2 = date("i:s", $login_time_limit);
} else {
    $now_time = $model->time_to_jalali_date("T");
    $login_time_limit2 = $now_time;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-language" content="fa"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <title> <?= $site_options["site_name"] ?></title>
    <link rel="stylesheet" href="<?= SITE_URL ?>public/admin/assets/plugins/morris/morris.css">
    <link href="<?= SITE_URL ?>public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet"
          type="text/css">
    <link href="<?= SITE_URL ?>public/admin/assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/css/core.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>public/admin/assets/css/pages.css" rel="stylesheet" type="text/css"/>
    <script src="<?= SITE_URL ?>public/admin/assets/js/modernizr.min.js"></script>
    <link type="text/css" rel="stylesheet"
          href="<?= SITE_URL ?>public/admin/assets/plugins/persianjalili/style/kamadatepicker.css"/>
    <script src="<?= SITE_URL ?>public/admin/assets/js/jquery.min.js"></script>
    <script src="<?= SITE_URL ?>public/admin/assets/plugins/persianjalili/src/kamadatepicker.js"></script>
    <!--    <script src="--><? //= SITE_URL ?><!--public\admin\assets\ckeditor/ckeditor.js"></script>-->
    <script src="<?= SITE_URL ?>public\admin\assets\plugins\ckeditor/ckeditor.js"></script>
    <link rel="shortcut icon" href="<?= SITE_URL ?>public/web/images/favicon.png">
    <!--    jquery ui-->
    <link href="<?= SITE_URL ?>public\admin\assets\js/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?= SITE_URL ?>public\admin\assets\js/jquery-ui.js"></script>
    <style>
        .has_sub ul li {
            display: none;
        }

        .has_sub ul {
        }

        .slimScrollBar {
            width: 10px !important;
        }

        table th, td {
            text-align: center;
        }

        input {
            text-align: center;
        }

        @media (max-width: 600px) {
            div.side-menu.left {
                position: fixed !important;
                width: 100%;
            }
        }


    </style>
</head>

<?php if ($all_access == "all") { ?>
    <style>
        .has_sub ul li {
            display: block;
        }
    </style>
<?php } else if (is_array($all_access)) {
    foreach ($all_access as $access_row) {
        ?>
        <style>
            .has_sub ul li.<?= $access_row ?> {
                display: block;
            }
        </style>
    <?php }
} ?>

<body class="fixed-left">
<div style="float: left;width: 100%;height: 30px"></div>
<div id="wrapper">

    <div class="topbar">
        <div class="topbar-left">
            <div class="text-center">
                <a href="" class="logo">
                    <span><?= $site_options["site_name"] ?></span>
                </a>
            </div>
        </div>
        <div class="">
            <div class="pull-left">
                <button class="button-menu-mobile open-left waves-effect waves-light">
                    <i class="md md-menu"></i>
                </button>
                <span class="clearfix"></span>
            </div>
        </div>

        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="hidden-xs">
                            <a class="waves-effect waves-light">
                                <?php if (!empty($_SESSION["admin_login_time"]) and $_SESSION["admin_login_time"] > time()) { ?>
                                    <span style="margin: 0 10px 0 10px;"> محدودیت زمان پنل مدیریت </span>
                                <?php } ?>
                                <span class="active_time"> <?= $login_time_limit2 ?> </span>
                                <i class="fa  fa-clock-o"></i>
                                <script>
                                    var counter = 0;
                                    setInterval(function () {
                                        var nowtime = Math.abs(Math.floor(new Date() / 1000));
                                        var left =  <?= $_SESSION["admin_login_time"] ?> -nowtime;
                                        if (nowtime <= <?= $_SESSION["admin_login_time"]  ?>) {
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
                            </a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light">
                                <i class="icon-size-fullscreen"></i>
                            </a>
                        </li>

                        <?php if (isset($_COOKIE['clerk']) and isset($_SESSION['clerk']) and $_COOKIE['clerk'] == $_SESSION['clerk']) { ?>
                            <li class="dropdown top-menu-item-xs">
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle profile waves-effect waves-light"
                                   data-toggle="dropdown" aria-expanded="true">
                                    <img src="<?= SITE_URL ?>public/admin/assets/images/small/img4.jpg"
                                         alt="user-img"
                                         class="img-circle">
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="admin_options"><a href="<?= SITE_URL ?>admin_options">
                                            <i class="ti-settings m-r-10 text-custom"></i>تنظیمات</a></li>

                                    <li><a href="<?= SITE_URL ?>admin_login/logout">
                                            <i class="ti-power-off m-r-10 text-danger"></i>خروج</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_COOKIE['clerk']) and isset($_SESSION['clerk']) and $_COOKIE['clerk'] == $_SESSION['clerk']) { ?>
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="ti-home"></i>
                                <span class="menu-arrow"></span> داشبورد </a>
                            <ul class="list-unstyled">
                                <li class=" admin_panel"><a href="<?= SITE_URL ?>admin_panel" class="waves-effect">
                                        <i class="ti-home"></i><span>  داشبورد  </span></a></li>
                                <li class=" admin_chart"><a href="<?= SITE_URL ?>admin_chart" class="waves-effect">
                                        <i class="ti-home"></i><span> آمار سایت  </span></a></li>
                                <li class=" admin_chart"><a href="<?= SITE_URL ?>chat/php/app.php/admin"
                                                            class="waves-effect">
                                        <i class="ti-home"></i><span>چت باکس </span></a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت </a>
                            <ul class="list-unstyled">
                                <li class="admin_panel"><a href="<?= SITE_URL ?>admin_panel/menu">منو ها</a>
                                </li>
                                <li class="admin_panel"><a href="<?= SITE_URL ?>admin_panel/news_letter"> خبرنامه</a>
                                </li>
                                <li class="admin_social"><a href="<?= SITE_URL ?>admin_social"> شبکه های اجتماعی </a>
                                </li>
                                <li class="admin_options"><a href="<?= SITE_URL ?>admin_options"> تنظیمات </a></li>
                                <li class="admin_access"><a href="<?= SITE_URL ?>admin_access"> دسترسی ها </a></li>
                                <li class="admin_password_change">
                                    <a href="<?= SITE_URL ?>admin_password_change"> تغییر رمز ورود </a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i><span class="menu-arrow"></span>مدیریت مطالب </a>
                            <ul class="list-unstyled">
                                <li class="admin_posts">
                                    <a href="<?= SITE_URL ?>admin_posts/add_post"> افزودن پست جدید </a></li>
                                <li class="admin_posts"><a href="<?= SITE_URL ?>admin_posts"> مدیریت پست ها </a></li>
                                <li class="admin_category">
                                    <a href="<?= SITE_URL ?>admin_category"> مدیریت مجموعه ها </a></li>
                                <li class="admin_posts">
                                    <a href="<?= SITE_URL ?>admin_posts/deleted"> پست های حذف شده </a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت کاربران </a>
                            <ul class="list-unstyled">
                                <li class="admin_users_list">
                                    <a href="<?= SITE_URL ?>admin_users_list/admin_idea_room"> ثبت نام های اتاق فکر
                                        <span class="badge badge-danger"><?= $employ["count"] ?></span></a></li>
                                <li class="admin_resume"><a href="<?= SITE_URL ?>admin_resume">همکاری با ما
                                        <span class="badge badge-danger"><?= $resume["count"] ?></span></a></li>
                                <li class="admin_comments"><a href="<?= SITE_URL ?>admin_comments">پیام های کاربران
                                        <span class="badge badge-danger"><?= $count_com["count"] ?></span></a></li>
                                <li class="admin_clerk_list">
                                    <a href="<?= SITE_URL ?>admin_clerk_list"> مدیریت کاربران سیستم </a></li>
                                <li class="admin_add_user">
                                    <a href="<?= SITE_URL ?>admin_add_user"> افزودن کاربر سیستم </a></li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت گالری </a>
                            <ul class="list-unstyled">
                                <li class="admin_gallery_category"><a href="<?= SITE_URL ?>admin_gallery_category"> دسته
                                        بندی گالری </a></li>
                                <li class="admin_gallery"><a href="<?= SITE_URL ?>admin_gallery"> گالری و اسلایدر </a>
                                </li>
                                <li class="admin_gallery"><a href="<?= SITE_URL ?>admin_team">گالری تیم</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت ویدئو ها </a>
                            <ul class="list-unstyled">
                                <li class="admin_video/category"><a href="<?= SITE_URL ?>admin_video/category">
                                        دسته بندی ویدئو ها </a></li>
                                <li class="admin_video"><a href="<?= SITE_URL ?>admin_video"> ویدئو ها </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت فایلهای صوتی </a>
                            <ul class="list-unstyled">
                                <li class="admin_audio/category"><a href="<?= SITE_URL ?>admin_audio/category">
                                        دسته بندی فایلهای صوتی </a></li>
                                <li class="admin_audio"><a href="<?= SITE_URL ?>admin_audio"> فایلهای صوتی </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت نمونه کارها </a>
                            <ul class="list-unstyled">
                                <li class="admin_demo"><a href="<?= SITE_URL ?>admin_demo/category">
                                        دسته بندی نمونه کارها </a></li>
                                <li class="admin_demo"><a href="<?= SITE_URL ?>admin_demo"> گالری نمونه کارها </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="menu-arrow"></span> مدیریت پروژه ها </a>
                            <ul class="list-unstyled">
                                <li class="admin_projects"><a href="<?= SITE_URL ?>admin_projects">
                                        دسته بندی نمونه کارها </a></li>
                            </ul>
                        </li>
                        <li class="text-muted menu-title">فروشگاه</li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="ti-shopping-cart"></i> <span class="menu-arrow"></span> مدیریت محصولات </a>
                            <ul class="list-unstyled">
                                <li class="admin_ecomm_products"><a
                                            href="<?= SITE_URL ?>admin_ecomm_products/add_product">افزودن محصول جدید</a>
                                </li>
                                <li class="admin_ecomm_products"><a href="<?= SITE_URL ?>admin_ecomm_products"> لیست
                                        محصولات</a></li>
                                <li class="admin_ecomm_product_category"><a
                                            href="<?= SITE_URL ?>admin_ecomm_product_category"> مدیریت دسته بندی ها</a>
                                </li>
                                <li class="admin_ecomm_products">
                                    <a href="<?= SITE_URL ?>admin_ecomm_products/product_messages">نظرات کاربران</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="ti-shopping-cart"></i> <span class="menu-arrow"></span> مدیریت سفارشات </a>
                            <ul class="list-unstyled">

                                <li class="admin_ecomm_orders">
                                    <a href="<?= SITE_URL ?>admin_ecomm_orders">لیست سفارش ها </a></li>
                                <li class="admin_users_list">
                                    <a href="<?= SITE_URL ?>admin_users_list"> مدیریت اعضاء </a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    <?php } ?>

