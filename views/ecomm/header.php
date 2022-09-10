<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <title>imt shop</title>
    <link rel="shortcut icon" href="<?= SITE_URL ?>public/web/images/favicon.png">
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
    <!--    statistic-->
    <link rel="stylesheet" href="<?= SITE_URL ?>public/ecomm/dashboard-css/vendor/simple-line-icons.css">

</head>
<style>
    a {
        direction: rtl;
        text-decoration: none;
        /*color: #ffffff;*/
    }

    .m-r-20 {
        margin-right: 20px !important;
    }

    .active {
        display: inline-block !important;
    }

    .pointer {
        cursor: pointer;
    }

    .feature-list-title i {
        display: none;
    }
</style>
<body>
<!-- HEADER -->
<div class="header-wrap">
    <header>
        <!-- LOGO -->
        <a>
            <figure class="logo">
                <img src="<?= SITE_URL ?>public/ecomm/image/logo.png" alt="logo">
            </figure>
        </a>
        <!-- /LOGO -->

        <!-- MOBILE MENU HANDLER -->
        <div class="mobile-menu-handler left primary">
            <img src="<?= SITE_URL ?>public/ecomm/images/pull-icon.png" alt="pull-icon">
        </div>
        <a>
            <figure class="logo-mobile" style="width:200px!important;">
                <img src="<?= SITE_URL ?>public/ecomm/image/logo.png" alt="logo-mobile">
            </figure>
        </a>
        <?php if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) { ?>
            <div class="user-board">
                <!-- USER QUICKVIEW -->
                <div class="user-quickview">
                    <a href="<?= SITE_URL ?>users">
                        <div class="outer-ring">
                            <div class="inner-ring"></div>
                            <figure class="user-avatar">
                                <img src="<?= SITE_URL ?>public/ecomm/images/avatars/avatar_09.jpg" alt="avatar">
                            </figure>
                        </div>
                    </a>
                    <p class="user-name"
                       style="color: #d7be81!important;"><?= $user_info["name"] . " " . $user_info["family"] ?></p>
                    <!-- SVG ARROW -->
                    <svg class="svg-arrow">
                        <use xlink:href="<?= SITE_URL ?>"></use>
                    </svg>
                </div>
                <div class="account-actions">
                    <a href="<?= SITE_URL ?>users/user_logout" class="button secondary"
                       style="color: #505050">خروج از سیستم</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="user-board">
                <div class="account-actions no-space">
                    <a style="color: #505050" href="<?= SITE_URL ?>users/user_login" class="button secondary">ثبت
                        نام |
                        ورود</a>
                </div>

            </div>
        <?php } ?>

        <div class="user-board">

            <div class="account-information">
                <!--                    <div class="account-wishlist-quickview">-->
                <!--                        <a href="-->
                <? //= SITE_URL ?><!--users/favorite" style="text-decoration: none">-->
                <!--                            <span class="icon-heart" style="color: #d7be81;"></span>-->
                <!--                        </a>-->
                <!--                    </div>-->
                <div class="account-cart-quickview">
                    <a href="<?= SITE_URL ?>ecomm/basket">
                        <span class="fa fa-cart-plus" style="font-size: 24px;color: #d7be81;"></span>
                    </a>
                </div>
            </div>

        </div>
    </header>
</div>
<!-- /HEADER -->
<style>
    .closer {
        width: 30px;
        height: 30px;
        cursor: pointer !important;
        font-size: 30px;
        color: #ffffff;
        z-index: 9999;
        top: 0;
        left: 0;
    }

    a.closer {
        float: left !important;
        width: 30px !important;
        height: 30px !important;;
    }

    .row {
        float: right;
        width: 100%;
        min-height: 100px;
    }

    .interactive {
        float: right;
    }

    li.dropdown-item {
        width: 100%;
        float: right;
    }

    li.dropdown-item a {
        width: 100% !important;
        float: right;
        height: 40px !important;
        line-height: 40px !important;
    }

    .cat_childeren {
        float: right;
        width: 100%;
        padding: 0 10px 0 0;
        margin: 0;
    }

    .cat_childeren li {
        width: 100%;
        float: right;
    }

    .inner-dropdown {
        padding-right: 10px;
        float: right;
    }

    .inner-dropdown li {
        width: 100%;
        float: right;
    }

    .inner-dropdown-item {
        float: right;
        width: 100%;
        height: 30px !important;
    }

    .inner-dropdown-item a {
        color: #505050;
        padding: 5px 0;
    }
</style>
<!-- SIDE MENU -->
<div id="mobile-menu" class="side-menu left closed">
    <!-- SVG PLUS -->
    <a class="closer"><span class="fa fa-close  closer"></span></a>
    <div class="row">
        <?php if (isset($_COOKIE['user']) and isset($_SESSION['user']) and $_COOKIE['user'] == $_SESSION['user']) { ?>
            <div class="user-board">
                <!-- USER QUICKVIEW -->
                <div class="user-quickview">
                    <a href="<?= SITE_URL ?>users">
                        <div class="outer-ring">
                            <div class="inner-ring"></div>
                            <figure class="user-avatar">
                                <img src="<?= SITE_URL ?>public/ecomm/images/avatars/avatar_09.jpg" alt="avatar">
                            </figure>
                        </div>
                    </a>
                    <p class="user-name"
                       style="color: #d7be81!important;"><?= $user_info["name"] . " " . $user_info["family"] ?></p>
                    <!-- SVG ARROW -->
                    <svg class="svg-arrow">
                        <use xlink:href="<?= SITE_URL ?>"></use>
                    </svg>
                </div>
            </div>
        <?php } else { ?>
            <div class="user-board" style="width: auto;">
                <div class="account-actions no-space">
                    <a style="color: #505050" href="<?= SITE_URL ?>users/user_login" class="button secondary">ثبت نام |
                        ورود</a>
                </div>
            </div>

        <?php } ?>
    </div>

    <ul class="dropdown  dark hover-effect interactive">
        <?php
        foreach ($ecomm_menu as $menu) {
            ?>
            <li class="dropdown-item">
                <a href="<?= SITE_URL . $menu["link"] ?>"><?= $menu["name"] ?></a>
            </li>
        <?php } ?>
        <li class="dropdown-item interactive">
            <a>
                دسته بندی ها
            </a>
            <ul class="inner-dropdown">
                <!-- INNER DROPDOWN ITEM -->
                <?php foreach ($ecomm_category as $category) { ?>
                    <li class="inner-dropdown-item">
                        <p><?= $category["title"] ?></p>
                        <ul class="cat_childeren">
                            <?php foreach ($category["inner_menu"] as $categor) { ?>
                                <li class=" ">
                                    <a href="<?= SITE_URL ?>ecomm/products/<?= $categor["id"] ?>"><?= $categor["title"] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</div>

<div class="main-menu-wrap">
    <div class="menu-bar">
        <nav>
            <ul class="main-menu" style="margin: 0!important;">
                <!-- MENU ITEM -->
                <?php
                foreach ($ecomm_menu as $menu) {
                    ?>
                    <li class="menu-item">
                        <a href="<?= SITE_URL . $menu["link"] ?>"><?= $menu["name"] ?></a>
                    </li>
                <?php } ?>
                <li class="menu-item sub">
                    <a class="pointer">دسته بندی ها </a>
                    <div class="content-dropdown">
                        <?php foreach ($ecomm_category as $category) { ?>
                            <div class="feature-list-block subcat_list">
                                <h6 class="feature-list-title pointer">
                                    <i class="fa active  fa-angle-double-down m-r-20"></i>
                                    <!--                                    <i class="fa active  fa-angle-double-left m-r-20"></i>-->
                                    <span><?= $category["title"] ?></span>
                                </h6>
                                <hr class="line-separator">
                                <ul class="feature-list">
                                    <?php foreach ($category["inner_menu"] as $categor) { ?>
                                        <li class="inner-dropdown-item">
                                            <a href="<?= SITE_URL ?>ecomm/products/<?= $categor["id"] ?>"><?= $categor["title"] ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </nav>
        <!--        <form class="search-form">-->
        <!--            <input type="text" class="rounded" name="search" id="search_products" placeholder="جستجوی محصولات">-->
        <!--            <input type="image" src="-->
        <? //= SITE_URL ?><!--public/ecomm/images/search-icon.png" alt="search-icon">-->
        <!--        </form>-->
    </div>
</div>

<script>
    //    function get_cat_childeren(item, cat_id) {
    //        var url = "<?//= SITE_URL ?>//ecomm/get_cat_childeren";
    //        var data = {"cat_id": cat_id};
    //        $.post(url, data, function (msg) {
    //            $(item).parents(".subcat_list").find("ul.feature-list").html("");
    //            $(item).find(".cat_childeren").html("");
    //            $.each(msg, function (key, value) {
    //                var cat_item = '<li class="inner-dropdown-item"><a href="<?//= SITE_URL ?>//ecomm/products/' + value["id"] + '">' + value["title"] + '</a></li>';
    //                $(item).parents(".subcat_list").find("ul.feature-list").append(cat_item);
    //                $(item).find("i.active").removeClass("active");
    //                $(item).find("i.inactive").addClass("active");
    //            })
    //        }, "json")
    //    }

    $(".closer").click(function () {
        $("div.side-menu").removeClass("open");
        $("div.side-menu").addClass("closed");
    });

</script>
