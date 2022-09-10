<?php
$product_info = $data["product_info"];
$product_message = $data["product_message"];
$product_id = $data["product_id"];
$product_gallery = $data["product_gallery"];
$product_attr = $data["product_attr"];
//print_r($product_info);

?>

<style>
    a {
        text-decoration: none !important;
    }

    a:hover {
        text-decoration: none !important;
        color: #cddaff;
    }

    button.mfp-close {
        padding: 3px 10px;
        font-size: 15px;
        position: relative;
        z-index: 999999 !important;
        top: 50px !important;
        left: 5px !important;
    }

    img.mfp-img {
        width: auto !important;
    }

    .fa-paper-plane {
        background-color: silver;
        text-align: center;
        line-height: 30px;
        color: #ffefeb;
    }


</style>
<!-- SECTION HEADLINE -->
<div class="section-headline-wrap v2">
    <div class="section-headline">
        <h2 style="margin: 0 0 0 0;"><?= $product_info["name"] ?></h2>
        <p>صفحه اصلی<span class="separator">/</span>محصول <span class="separator">/</span><span
                    class="current-section"><?= $product_info["title"] ?></span></p>
    </div>
</div>
<!-- /SECTION HEADLINE -->

<!-- SECTION -->
<div class="section-wrap">
    <div class="section">
        <!-- SIDEBAR -->
        <div class="sidebar right">
            <!-- SIDEBAR ITEM -->
            <div class="sidebar-item void buttons">
                <a href="javascript:void(0)" class="button big dark purchase" style="direction: rtl">
                    <span style="margin: 0 8px">  قیمت :  </span>
                    <span class=" "> <?= $product_info["price"] ?> </span>
                    <span style="margin: auto 5px 10px"> تومان </span>
                </a>
                <a href="javascript:void(0)" onclick="add_basket(this,<?= $product_info["id"] ?>)"
                   class="button big tertiary wcart">
                    <span class="icon-present"></span>
                    افزودن به سبد خرید
                </a>
                <a href="javascript:void(0)" onclick="add_favorit(this,<?= $product_info["id"] ?> )"
                   class="button big secondary wfav">
                    <span class="icon-heart"></span>
                    افزودن به علاقه مندی ها
                </a>
            </div>
            <!-- /SIDEBAR ITEM -->
        </div>
        <!-- CONTENT -->
        <div class="content left">
            <!-- POST -->
            <article class="post">
                <!-- POST IMAGE -->
                <div class="post-image" style="background-color: #b1afaf;">
                    <figure class="product-preview-image large liquid">
                        <img src="<?= SITE_URL ?>public/product/<?= $product_info["id"] ?>/gallery/l/<?= $product_info["image"] ?>"
                             alt="">
                    </figure>
                    <!-- SLIDE CONTROLS -->
                    <div class="slide-control-wrap">
                        <div class="slide-control rounded left"
                             style="color: white;text-align: center;line-height: 45px">
                            <i class="fa  fa-arrow-left "></i>
                        </div>

                        <div class="slide-control rounded right"
                             style="color: white;text-align: center;line-height: 45px">
                            <i class="fa  fa-arrow-right "></i>
                        </div>
                    </div>

                </div>
                <!-- /POST IMAGE -->
                <?php foreach ($product_gallery as $key => $product_img) {

                } ?>
                <!-- POST IMAGE SLIDES -->
                <div class="post-image-slides">
                    <!-- IMAGE SLIDES WRAP -->
                    <div class="image-slides-wrap full">
                        <!-- IMAGE SLIDES -->
                        <div class="image-slides" style="position: static" data-slide-visible-full="8"
                             data-slide-visible-small="2"
                             data-slide-count="<?= $key + 1 ?>">
                            <style>
                                figure.product-preview-image.large.liquid.imgLiquid_bgSize.imgLiquid_ready {
                                    background-size: contain !important;
                                }
                            </style>

                            <?php foreach ($product_gallery as $key => $product_img) { ?>
                                <div class="image-slide  ">
                                    <div class="overlay"></div>
                                    <figure class="product-preview-image thumbnail liquid">
                                        <img src="<?= SITE_URL ?>public/product/<?= $product_img["product_id"] ?>/gallery/l/<?= $product_img["img_name"] ?>"
                                             alt="">
                                    </figure>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <hr class="line-separator">

                <!-- POST CONTENT -->
                <div class="post-content">
                    <!-- POST PARAGRAPH -->
                    <div class="post-paragraph">
                        <h3 class="post-title"><?= $product_info["name"] ?></h3>
                        <p><?= $product_info["summary"] ?></p>
                    </div>

                    <div class="post-paragraph">
                        <p><?= $product_info["introduction"] ?></p>
                    </div>

                    <div class="post-paragraph half" style="direction: rtl">
                        <h4 class="post-title small" style="font-size: 16px"> ویژگی های محصول : </h4>
                        <!-- POST ITEM LIST -->
                        <ul class="post-item-list">
                            <?php
                            foreach ($product_attr as $attrs) {
                                ?>
                                <li style="padding-right: 0!important;">
                                    <p style="font-size: 15px;color: #f0d797;padding: 5px 0 10px!important;">
                                        <span><?= $attrs["title"] ?></span></p>
                                    <ul class="post-item-list">
                                        <?php foreach ($attrs["attr_child"] as $attr) { ?>
                                            <li style="padding-right: 0!important;  "><p>
                                                    <span><?= $attr["title"] ?></span><span> : </span><span><?= $attr["value"] ?></span>
                                                </p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="share-links-wrap">
                    <p class="text-header small">به اشتراک بگذارید :</p>
                    <!-- SHARE LINKS -->
                    <ul class="share-links hoverable">
                        <li>
                            <a href="https://telegram.me/share/url?url=<?= SITE_URL ?>ecomm/product/<?= $product_info["id"] ?>&text=<?= $product_info["summary"] ?>"
                               class="fa fa-paper-plane"></a></li>
                    </ul>
                    <!-- /SHARE LINKS -->
                </div>
                <!-- /SHARE -->
            </article>
            <!-- POST TAB -->
            <div class="post-tab">
                <!-- TAB HEADER -->
                <div class="tab-header tertiary">
                    <!-- TAB ITEM -->
                    <div class="tab-item selected">
                        <p class="text-header">نظر مشتریان</p>
                    </div>
                </div>
                <!-- TAB CONTENT -->
                <div class="tab-content void">
                    <!-- COMMENTS -->
                    <style>
                        .alert {
                            width: 100%;
                            padding: 20px;
                            text-align: center !important;
                            direction: rtl;
                        }

                        .alert_danger {
                            color: #fa332e;
                            background-color: rgba(255, 27, 16, 0.27);
                        }

                        .alert_warning {
                            color: #c5b07c;
                            background-color: rgba(246, 221, 153, 0.41);
                        }

                        .alert_success {
                            color: #67c165;
                            background-color: rgba(148, 253, 146, 0.41);
                        }

                        .close {
                            float: left;
                        }
                    </style>
                    <div class="comment-list">
                        <?php if (!empty($_SESSION ["save_message"]) and $_SESSION ["save_message"] == "success") { ?>
                            <h3 class="alert alert_success">پیام شما با موفقیت ارسال شد<span class="close">x</span>
                            </h3>
                        <?php } elseif (!empty($_SESSION ["save_message"]) and $_SESSION ["save_message"] == "danger") { ?>
                            <h3 class="alert alert_danger"> مشکل در ثبت پیام! <span class="close">x</span></h3>
                        <?php } elseif (!empty($_SESSION ["save_message"]) and $_SESSION ["save_message"] == "empty") { ?>
                            <h3 class="alert alert_warning">پیام نمیتواند خالی باشد !<span class="close">x</span></h3>
                        <?php }
                        unset($_SESSION ["save_message"]); ?>

                        <!-- COMMENT REPLY -->
                        <div class="comment-wrap comment-reply">
                            <!-- USER AVATAR -->
                            <a href="user-profile.html">
                                <figure class="user-avatar medium">
                                    <img src="<?= SITE_URL ?>public/ecomm/images/avatars/avatar_09.jpg" alt="">
                                </figure>
                            </a>
                            <!-- COMMENT REPLY FORM -->
                            <form class="comment-reply-form"
                                  action="<?= SITE_URL ?>ecomm/save_message/<?= $product_id ?>" method="post">
                                <textarea style="resize: none;direction: rtl" name="message"
                                          placeholder="متن خود رااینجا بنویسید..."></textarea>
                                <button type="submit" class="button tertiary">ارسال نظر</button>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                        <!-- LINE SEPARATOR -->
                        <hr class="line-separator">
                        <!-- COMMENT -->
                        <?php

                        if (!empty($product_message)) {
                            foreach ($product_message as $message) {
                                ?>
                                <div class="comment-wrap">
                                    <!-- USER AVATAR -->
                                    <a href="user-profile.html">
                                        <figure class="user-avatar medium">
                                            <img src="<?= SITE_URL ?>public/ecomm/images/avatars/avatar_09.jpg" alt="">
                                        </figure>
                                    </a>
                                    <!-- /USER AVATAR -->
                                    <div class="comment">
                                        <p class="text-header"><?= $message["name"] ?></p>
                                        <!-- /PIN -->
                                        <p class="timestamp"><?= $message["date"] ?></p>
                                        <p><?= $message["message"] ?></p>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            echo "<div style='float:right;width:100%;text-align:right;font-weight:bold;'><p>هیچ پیامی وجود ندارد</p> </div>";
                        } ?>
                        <!-- LINE SEPARATOR -->
                        <hr class="line-separator">
                    </div>
                    <!-- /COMMENTS -->
                </div>
                <!-- /TAB CONTENT -->
            </div>
            <!-- /POST TAB -->
        </div>
        <!-- CONTENT -->
    </div>
</div>
<!-- /SECTION -->

<script>
    $("span.close").click(function () {
        $(this).parents("h3.alert").fadeOut()
    });


    function add_favorit(item, product_id) {
        var url = "<?= SITE_URL ?>ecomm/add_favorit";
        var data = {"product_id": product_id};
        var item_old_class = $(item).find("span").attr("class");
        $(item).find("span").removeClass();
        $(item).find("span").addClass("fa fa-spin fa-spinner");
        $.post(url, data, function (msg) {
            if (msg == true) {
            } else if (msg == "login") {
                swal("", "لطفا وارد حساب کاربری شوید", "warning");
            } else if (msg == "was") {
                swal("", "قبلا به لیست مورد علاقه افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
            $(item).find("span").removeClass();
            $(item).find("span").addClass(item_old_class);
        })
    }

    function add_basket(item, product_id) {
        var url = "<?= SITE_URL ?>ecomm/add_basket";
        var data = {"product_id": product_id};
        var item_old_class = $(item).find("span").attr("class");
        $(item).find("span").removeClass();
        $(item).find("span").addClass("fa fa-spin fa-spinner");
        $.post(url, data, function (msg) {
            if (msg == true) {
                swal({
                    text: "",
                    title: "ثبت شد",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "اتمام خرید و پرداخت",
                    cancelButtonText: "ادامه خرید",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location = "<?= SITE_URL ?>ecomm/basket";
                    }
                });
            } else if (msg == "login") {
                // swal("", "لطفا وارد حساب کاربری شوید", "warning");
                window.location="<?= SITE_URL ?>users/user_login"
            } else if (msg == "was") {
                // swal("", "قبلا به لیست مورد علاقه افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
            $(item).find("span").removeClass();
            $(item).find("span").addClass(item_old_class);
        })
    }

    seen_product(<?= $product_id ?>);

    function seen_product(product_id) {
        var url = "<?= SITE_URL ?>ecomm/seen_product";
        var data = {'product_id': product_id};
        $.post(url, data, function (msg) {
        })
    }

</script>


