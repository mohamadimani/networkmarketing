<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 01/15/2019
 * Time: 04:06 PM
 */

$last_news = $data["last_news"];
$site_about = $data["site_about"];
$site_idea = $data["site_idea"];
$get_slider = $data["get_slider"];
$get_services = $data["get_services"];
//print_r($get_services);
//echo password_hash("0406", PASSWORD_BCRYPT, array('cost' => 12));

?>

<style>
    @media (max-width: 580px) {
        ul.slides {
            height: 25% !important;
        }

        div.our_service {
            padding-right: 8px;
            padding-left: 8px;
        }

        .service_new_color {
            border: 3px solid #5f6060;
            height: 75px !important;
            margin-bottom: 12px !important;
        }

        .webideItem {
            min-height: 80px;
        }

        .webideItem i {
            width: 50px;
            height: 70px;
            font-size: 30px;
            padding: 15px 0;
        }

        .webideItem .Systemcaption {
            padding-right: 46px;
            padding-top: 25px;
        }

    }
</style>

<ul class="slides">
    <?php foreach ($get_slider as $key => $slide) {
        $checked = "";
        if ($key == 0) {
            $checked = "checked";
        }
        ?>
        <input type="radio" name="radio-btn" id="img-<?= $key + 1 ?>" <?= $checked ?>/>
        <li class="slide-container">
            <div class="slide">
                <img src="<?= SITE_URL ?>public/images/gallery/<?= $slide["img_name"] ?>" alt="ریز پردازنده فراهوش"/>
            </div>
            <div class="nav">
                <label for="img-<?= $key + 2 ?>" class="prev">&#x2039;</label>
                <label for="img-<?= $key ?>" class="next">&#x203a;</label>
            </div>
        </li>
    <?php } ?>
    <li class="nav-dots">
        <?php foreach ($get_slider as $key => $slide) { ?>
            <label for="img-<?= $key + 1 ?>" class="nav-dot" id="img-dot-<?= $key + 1 ?>"></label>
        <?php } ?>
    </li>
</ul>

<script>
    var i = 1;
    setInterval(function () {
        i++;
        var slide_items = $("ul.slides").find("label.nav-dot");
        var len = parseInt(slide_items.length);
        $("#img-dot-" + i).click();
        if (i >= len) {
            i = 0;
        }
    }, 5000)
</script>

<!--end banner-top -->
<div id="section-service">
    <div class="container">
        <a href="<?= SITE_URL ?>blog"><h2 style="color: #333333" class="main-section-heading text-center">
                خدمات ما</h2></a>
        <div class="row">

            <?php foreach ($get_services as $key => $service) {

                $logo = "";
                if (trim($service["title"]) == "ربات") {
                    $logo = "fa fa-reddit-alien";
                } else if (trim($service["title"]) == "انیمیشن") {
                    $logo = "md md-perm-media";
                } else if (trim($service["title"]) == "لوگو و آرم") {
                    $logo = "fa fa-gg";
                } else if (trim($service["title"]) == "اپلیکیشن") {
                    $logo = "fa fa-android";
                } else if (trim($service["title"]) == "وب سایت") {
                    $logo = "fa fa-desktop";
                } else if (trim($service["title"]) == "تولید محتوا") {
                    $logo = "fa fa-video-camera";
                }
                ?>

                <div onclick="service_link(<?= $service["id"] ?>)" class="col-xs-6 col-sm-6 col-md-4 our_service"
                     style="cursor: pointer;">
                    <div class="service_new_color webideItem">
                        <a>
                            <i class="<?= $logo ?>" aria-hidden="true"></i>
                        </a>
                        <div class="Systemcaption">
                            <a>
                                <strong><?= $service["title"] ?></strong>
                            </a>
                        </div>
                        <span class="border"></span>
                    </div>

                </div>
                <!--end service1 -->
            <?php } ?>
        </div><!--end row -->
    </div>
</div><!--end service -->

<div class="preview-page-banner-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-7 ">
                <h2 class="about_us">  <?= $site_about["title"] ?></h2>
                <div class="des-full about_us ">   <?= $site_about["contect"] ?> </div>
                <a class="btn-mr2" href="<?= SITE_URL ?>about">توضیحات بیشتر</a>
            </div>
        </div>
    </div>
</div><!--end preview-page-banner -->

<div class="news-section">
    <div class="container">
        <div class="row">
            <a target="_blank" href="<?= SITE_URL ?>blog"><h2 style="color: #333333"
                                                              class="main-section-heading text-center">
                    آخرین <?= $last_news[0]['category_name'] ?></h2></a>
            <?php foreach ($last_news as $new) { ?>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="home3-single-blog">
                        <div class="blog-thubm-3">
                            <img src="<?= SITE_URL ?>public/posts/<?= $new["id"] ?>/<?= $new["img_name"] ?>"
                                 alt="<?= $new["img_name"] ?>" style="height: 200px;">
                        </div>
                        <!-- end blog thumb -->
                        <div class="blog-article3" onclick="service_link(<?= $new["id"] ?>)"
                             style="cursor: pointer;    ">
                            <ul>
                                <li><a><i class="fa fa-calendar-check-o"></i> <?= $new["new_date"] ?></a></li>
                            </ul>
                            <h2><a><?= $new["title"] ?></a></h2>
                            <div class="desc-blog">
                                <p><?= $new["contect"] ?></p>
                            </div>
                            <a target="_blank" href="<?= SITE_URL ?>single/index/<?= $new["id"] ?>" class="link-2 "
                               style="color: #31708f!important;">بیشتر...</a>
                        </div>

                    </div>
                </div><!-- end col-6 -->
            <?php } ?>
        </div>
    </div>
</div><!--end projectFacts -->

<!-- ===== modal =====-->
<div class="modal-dialog">
    <div id="body-overlay" style=" display: none;position: absolute;z-index: 9999999999;right: 50%;top:50%;">
        <div><img src="<?= SITE_URL ?>public\admin\images/loading.gif" alt="loading" width="64px" height="64px "/></div>
    </div>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> فرم ثبت نام در اتاق فکر </h4>
        </div>
        <!--        alert message -->
        <div class="alerts"></div>

        <form action="<?= SITE_URL ?>index/save_idea_employ" method="post" id="uploadForm">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">نام و نام خانوادگی</label>
                            <input type="text" class="form-control" id="field-1" name="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">موبایل </label>
                            <input type="tel" class="form-control" id="field-2" name="mobile">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="field-7" class="control-label"> دلیل ورود به اتاق فکر</label>
                                <textarea class="form-control autogrow" id="field-7"
                                          placeholder="100 کاراکتر در مورد خود بنویسید" minlength="100" name="comment"
                                          style="overflow: auto; word-wrap: break-word; resize: none; height: 104px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label"><?= $data["captcha"]; ?></label>
                            <input type="text" class="form-control" id="field-1" name="captcha">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default waves-effect"
                        onclick="reset_form()"
                        data-dismiss="modal">بستن
                </button>
                <button type="submit" class="btn btn-info waves-effect waves-light">ذخیره تغیرات</button>
            </div>
        </form>
    </div>
</div>

<div class="full-section-webideh">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-7  ">
                <h2 class="about_us"><?= $site_idea["title"] ?></h2>
                <div class="des-full about_us">
                    <?= $site_idea["contect"] ?>
                </div>
                <a class="btn-mr2 " href="<?= SITE_URL ?>single/index/<?= $site_idea["id"] ?>"> ادامه توضیحات</a>
                <a class="btn-mr2 float_right" onclick=" $('.modal-dialog').fadeIn();"> ثبت نام در اتاق فکر</a>
            </div>
        </div>
    </div>
</div><!--end preview-page-banner -->
</div><!-- end  -->

<script>

    seen_page();
    function seen_page() {
        var url = "<?= SITE_URL ?>index/seen_page";
        var data = {'page_name': 'index'};
        $.post(url, data, function (msg) {
        })
    }


    function service_link(id) {
        window.location = "<?= SITE_URL ?>single/index/" + id
    }

    function reset_form() {
        $('.modal-dialog').fadeOut();
        $('div.alerts').html(" ")
    }

    $(document).ready(function (e) {
        $("#uploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= SITE_URL ?>index/save_idea_employ",
                type: "POST",
                dataType: "json",
                data: new FormData(this),
                beforeSend: function () {
                    $("#body-overlay").show();
                },
                contentType: false,
                processData: false,
                success: function (data) {
                    $("div.alerts").html(" ");
                    $.each(data, function (index, value) {
                        if (index == "success") {
                            var success = '<div class="alert alert-success alert-dismissable text-center  "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><a class="alert-link">' + value + '</a></div>';
                            $("div.alerts").append(success);
                        } else {
                            var error = '<div class="alert alert-danger alert-dismissable text-center  "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><a class="alert-link">' + value + '</a></div>';
                            $("div.alerts").append(error);
                        }
                    });
                    setInterval(function () {
                        $("#body-overlay").hide();
                    }, 1000);
                },
                error: function () {
                }
            });
        }));
    });

</script>