<?php
$new_products = $data["new_products"];
$top_sell_products = $data["top_sell_products"];
$top_view_products = $data["top_view_products"];
?>


<div class="banner-wrap">
    <img src="<?= SITE_URL ?>public/ecomm/image/banner.png" alt="">

</div>

<div id="services-wrap">
    <section id="services" style="min-height:300px!important;">
        <!-- SERVICE LIST -->
        <div class="service-list column4-wrap">
            <!-- SERVICE ITEM -->
            <a href="<?= SITE_URL ?>users/user_login">
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="fa fa-key"></span>
                    </div>
                    <h3>ثبت نام</h3>
                </div>
            </a>

            <!-- SERVICE ITEM -->
            <a href="<?= SITE_URL ?>users/user_login">
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-lock"></span>
                    </div>
                    <h3>ورود</h3>
                </div>
            </a>

            <a href="<?= SITE_URL ?>ecomm/basket">
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="fa fa-cart-plus"></span>
                    </div>
                    <h3>سبد خرید</h3>
                </div>
            </a>
            <!-- /SERVICE ITEM -->
            <a href="<?= SITE_URL ?>users/favorites">
                <div class="service-item column">
                    <div class="circle medium gradient"></div>
                    <div class="circle white-cover"></div>
                    <div class="circle dark">
                        <span class="icon-heart"></span>
                    </div>
                    <h3>مورد علاقه ها</h3>
                </div>
            </a>
            <!-- /SERVICE ITEM -->
        </div>
        <!-- /SERVICE LIST -->
        <div class="clearfix"></div>
    </section>
</div>
<!-- /SERVICES -->

<style>
    .banner-wrap img {
        width: 100%;
        /*height: 552px;*/
        float: left;
    }

    .banner {
        height: auto !important;
    }

    div.right, div.left {
        text-align: center;
        color: white;
        font-weight: bold;
    }

    div.right i, div.left i {
        margin: 8px 0 0 0;
    }

    div.like {
        float: right;
    }

    span.like, span.dislike {
        margin: 1px 5px;
        font-size: 16px;
    }

    a {
        text-decoration: none !important;
    }

    .headline h4 {
        line-height: 44px !important;
    }

    .banner-wrap {
        height: 100% !important;
        float: right;
        width: 100%;
    }

    .banner-wrap .banner {
        height: 100%;
    }

    .circle span {
        right: 12px;
    }

    p.lead.text-muted {
        text-align: center !important;
    }

    div#services-wrap {
        float: right;
        width: 100%;
    }

    p.lead.text-muted {
        padding: 11px 0 0 0;
    }

    .add_basket {
        font-size: 18px !important;
        color: #af9a69;
        margin-right: 30px !important;
    }
</style>

<div class="clearfix"></div>

<!-- PRODUCT SIDESHOW -->
<div id="product-sideshow-wrap">
    <div id="product-sideshow">
        <!-- PRODUCT SHOWCASE -->
        <div class="product-showcase">
            <!-- HEADLINE -->
            <div class="headline primary">
                <h4>جدیدترین محصولات</h4>
                <!-- SLIDE CONTROLS -->
                <div class="slide-control-wrap">
                    <div class="slide-control left">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-left"></i>
                        <!-- /SVG ARROW -->
                    </div>

                    <div class="slide-control right">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-right"></i>
                        <!-- /SVG ARROW -->
                    </div>
                </div>
                <!-- /SLIDE CONTROLS -->
            </div>
            <!-- /HEADLINE -->
            <!-- PRODUCT LIST -->
            <div id="pl-1" class="product-list grid column4-wrap owl-carousel">
                <?php foreach ($new_products as $new_product) { ?>
                    <!-- PRODUCT ITEM -->
                    <div class="product-item column">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image" style="text-align: center">
                                <img src="<?= SITE_URL ?>public/product/<?= $new_product["id"] ?>/gallery/l/<?= $new_product["image"] ?>"
                                     alt="<?= $new_product["seo"] ?>" style="width: auto">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                            <!-- PREVIEW ACTIONS -->
                            <div class="preview-actions">
                                <!-- PREVIEW ACTION -->
                                <div class="preview-action">
                                    <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                        <div class="circle tiny primary">
                                            <span class="icon-tag"></span>
                                        </div>
                                        <p>نمایش</p>
                                    </a>
                                </div>
                                <!-- /PREVIEW ACTION -->

                                <!-- PREVIEW ACTION -->
                                <div class="preview-action">
                                    <a href="javascript:void(0)" onclick="add_favorit(this,<?= $new_product["id"] ?>)">
                                        <div class="circle tiny secondary">
                                            <span class="fa fa-heart-o"></span>
                                        </div>
                                        <p>علاقه مندی ها +</p>
                                    </a>
                                </div>
                                <!-- /PREVIEW ACTION -->
                            </div>
                            <!-- /PREVIEW ACTIONS -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->

                        <!-- PRODUCT INFO -->
                        <div class="product-info">
                            <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                <p class="text-header"><?= $new_product["name"] ?></p>
                            </a>
                            <p class="product-description"><?= $new_product["summary"] ?></p>
                            <a href="<?= SITE_URL ?>ecomm/category">
                                <p class="category primary"><?= $new_product["title"] ?></p>
                            </a>
                            <p class="price"><span>تومان</span><?= $new_product["price"] ?></p>
                        </div>
                        <!-- /PRODUCT INFO -->
                        <hr class="line-separator">

                        <!-- USER RATING -->
                        <div class="user-rating">
                            <div class="like">
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'like')">
                                    <span class="fa  fa-thumbs-o-up like "></span>
                                </a>
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'dislike')">
                                    <span class="fa  fa-thumbs-o-down dislike"></span>
                                </a>
                            </div>

                            <div class="like">
                                <a href="javascript:void(0)" onclick="add_basket(this,<?= $new_product["id"] ?>)">
                                    <span class="fa fa-cart-plus  add_basket " title="افزودن به سبد خرید"></span>
                                </a>
                            </div>
                            <?php
                            if ($new_product['likes'] > 0) {
                                $all_likes = $new_product['likes'] + $new_product["dislikes"];
                                $like_stars = ((($new_product['likes'] * 100) / $all_likes) / 10) / 2;
                                $empty_stars = 5 - $like_stars;
                                $like_stars = floor($like_stars);
                                $empty_stars = floor($empty_stars);
                                $half_star = 5 - ($like_stars + $empty_stars);
                                for ($i = 1; $i <= $like_stars; $i++) { ?>
                                    <span class="fa fa-star text-warning"></span>
                                <?php }
                                if ($half_star >= 1) {
                                    for ($i = 1; $i <= $half_star; $i++) { ?>
                                        <span class="fa fa-star-half-o text-warning"></span>
                                    <?php }
                                }
                                if ($empty_stars >= 1) {
                                    for ($i = 1; $i <= $empty_stars; $i++) { ?>
                                        <span class="fa fa-star-o"></span>
                                    <?php }
                                } ?>
                            <?php } else { ?>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                            <?php } ?>
                            <!-- <span class="fa fa-star-half-o"></span>-->
                        </div>
                        <!-- /USER RATING -->
                    </div>
                    <!-- /PRODUCT ITEM -->
                <?php } ?>
            </div>
            <!-- /PRODUCT LIST -->
        </div>
        <!-- /PRODUCT SHOWCASE -->
        <!-- PRODUCT SHOWCASE -->
        <div class="product-showcase">
            <!-- HEADLINE -->
            <div class="headline">
                <h4>پرفروش ترین محصولات</h4>
                <!-- SLIDE CONTROLS -->
                <div class="slide-control-wrap">
                    <div class="slide-control left">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-left"></i>
                        <!-- /SVG ARROW -->
                    </div>

                    <div class="slide-control right">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-right"></i>
                        <!-- /SVG ARROW -->
                    </div>
                </div>
                <!-- /SLIDE CONTROLS -->
            </div>
            <!-- /HEADLINE -->
            <!-- PRODUCT LIST -->
            <div id="pl-5" class="product-list grid column4-wrap owl-carousel">
                <!-- PRODUCT ITEM -->
                <?php foreach ($top_sell_products as $new_product) { ?>
                    <!-- PRODUCT ITEM -->
                    <div class="product-item column">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image" style="text-align: center">
                                <img src="<?= SITE_URL ?>public/product/<?= $new_product["id"] ?>/gallery/l/<?= $new_product["image"] ?>"
                                     alt="<?= $new_product["seo"] ?>" style="width: auto;">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                            <!-- PREVIEW ACTIONS -->
                            <div class="preview-actions">
                                <!-- PREVIEW ACTION -->
                                <div class="preview-action">
                                    <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                        <div class="circle tiny primary">
                                            <span class="icon-tag"></span>
                                        </div>
                                        <p>نمایش</p>
                                    </a>
                                </div>

                                <div class="preview-action">
                                    <a href="javascript:void(0)" onclick="add_favorit(this,<?= $new_product["id"] ?>)">
                                        <div class="circle tiny secondary">
                                            <span class="fa fa-heart-o "></span>
                                        </div>
                                        <p>علاقه مندی ها +</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="product-info">
                            <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                <p class="text-header"><?= $new_product["name"] ?></p>
                            </a>
                            <p class="product-description"><?= $new_product["summary"] ?></p>
                            <a href="<?= SITE_URL ?>ecomm/category">
                                <p class="category primary"><?= $new_product["title"] ?></p>
                            </a>
                            <p class="price"><span>تومان</span><?= $new_product["price"] ?></p>
                        </div>
                        <!-- /PRODUCT INFO -->
                        <hr class="line-separator">

                        <div class="user-rating">
                            <div class="like">
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'like')">
                                    <span class="fa  fa-thumbs-o-up like "></span>
                                </a>
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'dislike')">
                                    <span class="fa  fa-thumbs-o-down dislike"></span>
                                </a>
                            </div>
                            <div class="like">
                                <a href="javascript:void(0)" onclick="add_basket(this,<?= $new_product["id"] ?>)">
                                    <span class="fa fa-cart-plus  add_basket " title="افزودن به سبد خرید"></span>
                                </a>
                            </div>
                            <?php
                            if ($new_product['likes'] > 0) {
                                $all_likes = $new_product['likes'] + $new_product["dislikes"];
                                $like_stars = ((($new_product['likes'] * 100) / $all_likes) / 10) / 2;
                                $empty_stars = 5 - $like_stars;
                                $like_stars = floor($like_stars);
                                $empty_stars = floor($empty_stars);
                                $half_star = 5 - ($like_stars + $empty_stars);
                                for ($i = 1; $i <= $like_stars; $i++) { ?>
                                    <span class="fa fa-star text-warning"></span>
                                <?php }
                                if ($half_star >= 1) {
                                    for ($i = 1; $i <= $half_star; $i++) { ?>
                                        <span class="fa fa-star-half-o text-warning"></span>
                                    <?php }
                                }
                                if ($empty_stars >= 1) {
                                    for ($i = 1; $i <= $empty_stars; $i++) { ?>
                                        <span class="fa fa-star-o"></span>
                                    <?php }
                                } ?>
                            <?php } else { ?>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- PRODUCT SHOWCASE -->
        <div class="product-showcase">
            <!-- HEADLINE -->
            <div class="headline secondary">
                <h4>پربازدید ترین محصولات</h4>
                <!-- SLIDE CONTROLS -->
                <div class="slide-control-wrap">
                    <div class="slide-control left">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-left"></i>
                        <!-- /SVG ARROW -->
                    </div>
                    <div class="slide-control right">
                        <!-- SVG ARROW -->
                        <i class="fa fa-angle-right"></i>
                        <!-- /SVG ARROW -->
                    </div>
                </div>
                <!-- /SLIDE CONTROLS -->
            </div>
            <!-- /HEADLINE -->
            <!-- PRODUCT LIST -->
            <div id="pl-4" class="product-list grid column4-wrap owl-carousel">
                <!-- PRODUCT ITEM -->
                <?php foreach ($top_view_products as $new_product) { ?>
                    <!-- PRODUCT ITEM -->
                    <div class="product-item column">
                        <!-- PRODUCT PREVIEW ACTIONS -->
                        <div class="product-preview-actions">
                            <!-- PRODUCT PREVIEW IMAGE -->
                            <figure class="product-preview-image" style="text-align: center">
                                <img src="<?= SITE_URL ?>public/product/<?= $new_product["id"] ?>/gallery/l/<?= $new_product["image"] ?>"
                                     alt="<?= $new_product["seo"] ?>" style="width:  auto">
                            </figure>
                            <!-- /PRODUCT PREVIEW IMAGE -->
                            <!-- PREVIEW ACTIONS -->
                            <div class="preview-actions">
                                <!-- PREVIEW ACTION -->
                                <div class="preview-action">
                                    <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                        <div class="circle tiny primary">
                                            <span class="icon-tag"></span>
                                        </div>
                                        <p>نمایش</p>
                                    </a>
                                </div>
                                <!-- /PREVIEW ACTION -->

                                <!-- PREVIEW ACTION -->
                                <div class="preview-action">
                                    <a href="javascript:void(0)" onclick="add_favorit(this,<?= $new_product["id"] ?>)">
                                        <div class="circle tiny secondary">
                                            <span class=" fa fa-heart-o"></span>
                                        </div>
                                        <p>علاقه مندی ها +</p>
                                    </a>
                                </div>
                                <!-- /PREVIEW ACTION -->
                            </div>
                            <!-- /PREVIEW ACTIONS -->
                        </div>
                        <!-- /PRODUCT PREVIEW ACTIONS -->

                        <!-- PRODUCT INFO -->
                        <div class="product-info">
                            <a href="<?= SITE_URL ?>ecomm/product/<?= $new_product["id"] ?>">
                                <p class="text-header"><?= $new_product["name"] ?></p>
                            </a>
                            <p class="product-description"><?= $new_product["summary"] ?></p>
                            <a href="<?= SITE_URL ?>ecomm/category">
                                <p class="category primary"><?= $new_product["title"] ?></p>
                            </a>
                            <p class="price"><span>تومان</span><?= $new_product["price"] ?></p>
                        </div>
                        <!-- /PRODUCT INFO -->
                        <hr class="line-separator">

                        <!-- USER RATING -->
                        <div class="user-rating">
                            <div class="like">
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'like')">
                                    <span class="fa  fa-thumbs-o-up like "></span>
                                </a>
                                <a href="javascript:void(0)"
                                   onclick="set_like(this,<?= $new_product["id"] ?>,'dislike')">
                                    <span class="fa  fa-thumbs-o-down dislike"></span>
                                </a>
                            </div>
                            <div class="like">
                                <a href="javascript:void(0)" onclick="add_basket(this,<?= $new_product["id"] ?>)">
                                    <span class="fa fa-cart-plus  add_basket " title="افزودن به سبد خرید"></span>
                                </a>
                            </div>
                            <?php
                            if ($new_product['likes'] > 0) {
                                $all_likes = $new_product['likes'] + $new_product["dislikes"];
                                $like_stars = ((($new_product['likes'] * 100) / $all_likes) / 10) / 2;
                                $empty_stars = 5 - $like_stars;
                                $like_stars = floor($like_stars);
                                $empty_stars = floor($empty_stars);
                                $half_star = 5 - ($like_stars + $empty_stars);
                                for ($i = 1; $i <= $like_stars; $i++) { ?>
                                    <span class="fa fa-star text-warning"></span>
                                <?php }
                                if ($half_star >= 1) {
                                    for ($i = 1; $i <= $half_star; $i++) { ?>
                                        <span class="fa fa-star-half-o text-warning"></span>
                                    <?php }
                                }
                                if ($empty_stars >= 1) {
                                    for ($i = 1; $i <= $empty_stars; $i++) { ?>
                                        <span class="fa fa-star-o"></span>
                                    <?php }
                                } ?>
                            <?php } else { ?>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                            <?php } ?>
                            <!-- <span class="fa fa-star-half-o"></span>-->
                        </div>
                        <!-- /USER RATING -->
                    </div>
                    <!-- /PRODUCT ITEM -->
                <?php } ?>
                <!-- /PRODUCT ITEM -->
            </div>
            <!-- /PRODUCT LIST -->
        </div>
        <!-- /PRODUCT SHOWCASE -->
    </div>
</div>

<div id="subscribe-banner-wrap">
    <div id="subscribe-banner">
        <div class="subscribe-content">
            <div class="subscribe-header">
                <figure>
                    <img src="<?= SITE_URL ?>public/ecomm/images/news_icon.png" alt="subscribe-icon"
                         style="width: auto">
                </figure>
                <p class="subscribe-title">اشتراک در خبرنامه ما</p>
                <p>و دریافت آخرین اخبار و پیشنهادات</p>
            </div>
            <form class="subscribe-form" onsubmit="set_newslatter(this,event)" method="post"
                  action="<?= SITE_URL ?>ecomm/newsletter">
                <input type="text" name="subscribe_email" id="subscribe_email"
                       placeholder="آدرس پست الکترونیک خود را وارد کنید">
                <button class="button medium dark">عضویت</button>
            </form>
        </div>
    </div>
</div>


<script>

    function set_like(item, product_id, param) {
        var url = "<?= SITE_URL ?>ecomm/set_like";
        var data = {"product_id": product_id, "param": param};
        var item_old_class = $(item).find("span").attr("class");
        $(item).find("span").removeClass();
        $(item).find("span").addClass("fa fa-spin fa-spinner");
        $.post(url, data, function (msg) {
            if (msg == true) {
            } else if (msg == "login") {
                swal("", "لطفا وارد حساب کاربری شوید", "warning");
            } else if (msg == "was") {
                swal("", "قبلا رای شما افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
            $(item).find("span").removeClass();
            $(item).find("span").addClass(item_old_class);
        })
    }

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

    function set_newslatter(item, e) {
        e.preventDefault();
        var email = $(item).find("input").val();
        var url = "<?= SITE_URL ?>ecomm/newsletter";
        var data = {"email": email};
        $.post(url, data, function (msg) {
            if (msg == true) {
                swal("", "  افزوده شد ", "success");
            } else if (msg == "was") {
                swal("", "این ایمیل قبلا به خبرنامه افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
        })
    }

    function add_basket(item, product_id) {
        var url = "<?= SITE_URL ?>ecomm/add_basket";
        var data = {"product_id": product_id};
        var item_old_class = $(item).find("span").attr("class");
        $(item).find("span").removeClass();
        $(item).find("span").addClass("fa fa-spin fa-spinner");
        $.post(url, data, function (msg) {
            // alert(msg);
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
                window.location = "<?= SITE_URL ?>users/user_login"
            } else if (msg == "was") {
                // swal("", "قبلا به لیست  افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
            $(item).find("span").removeClass();
            $(item).find("span").addClass(item_old_class);
        })
    }

</script>