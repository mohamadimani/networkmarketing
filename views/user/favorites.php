<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 03/16/2019
 * Time: 11:51 AM
 */
$products = $data["favorites"];
?>

<style>

    .dashboard-body {
        padding-top: 0 !important;
    }

    .section {
        padding-top: 80px !important;
    }

    .circle span {
        right: 10px;
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

    .column3-4-wrap .column {
        margin-left: 20px !important;
    }

    .column3-4-wrap .column:nth-child(4n+4) {
        /*margin-left: 0 !important;*/
    }

    .add_basket {
        font-size: 18px !important;
        color: #af9a69;
        margin-right: 30px !important;
    }


</style>
<!-- SECTION -->
<div class="section-wrap">
    <div class="section">
        <!-- CONTENT -->
        <div class="content" style="width: 100%;">
            <!-- HEADLINE -->
            <div class="headline tertiary">
                <h4 style="margin: 0;"> محصولات مورد علاقه</h4>
                <!-- VIEW SELECTORS -->
            </div>

            <div class="product-showcase" style="width: 100%;">
                <!-- PRODUCT LIST -->
                <div class="product-list grid column3-4-wrap" style="width: 100%;">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) { ?>

                            <div class="product-item column">
                                <!-- PRODUCT PREVIEW ACTIONS -->
                                <div class="product-preview-actions">
                                    <!-- PRODUCT PREVIEW IMAGE -->
                                    <figure class="product-preview-image" style="text-align: center">
                                        <img src="<?= SITE_URL ?>public/product/<?= $product["id"] ?>/gallery/l/<?= $product["image"] ?>"
                                             alt="<?= $product["seo"] ?>" style="width: auto;height: 100%!important;">
                                    </figure>

                                    <div class="preview-actions">
                                        <!-- PREVIEW ACTION -->
                                        <div class="preview-action">
                                            <a href="<?= SITE_URL ?>ecomm/product/<?= $product["id"] ?>">
                                                <div class="circle tiny primary">
                                                    <span class="icon-tag"></span>
                                                </div>
                                                <p>نمایش</p>
                                            </a>
                                        </div>

                                        <!--                                        <div class="preview-action">-->
                                        <!--                                            <a href="javascript:void(0)"-->
                                        <!--                                               onclick="add_favorit(this,-->
                                        <?//= $product["id"] ?><!--)">-->
                                        <!--                                                <div class="circle tiny secondary">-->
                                        <!--                                                    <span class="fa fa-heart-o "></span>-->
                                        <!--                                                </div>-->
                                        <!--                                                <p>علاقه مندی ها +</p>-->
                                        <!--                                            </a>-->
                                        <!--                                        </div>-->
                                        <!-- /PREVIEW ACTION -->
                                    </div>
                                    <!-- /PREVIEW ACTIONS -->
                                </div>

                                <!-- PRODUCT INFO -->
                                <div class="product-info">
                                    <a href="<?= SITE_URL ?>ecomm/product/<?= $product["id"] ?>">
                                        <p class="text-header"><?= $product["name"] ?></p>
                                    </a>
                                    <p class="product-description"><?= $product["summary"] ?></p>
                                    <p class="price"><span>تومان</span><?= $product["price"] ?></p>
                                </div>
                                <!-- /PRODUCT INFO -->
                                <hr class="line-separator">

                                <!-- USER RATING -->
                                <div class="user-rating">
                                    <div class="like">
                                        <a href="javascript:void(0)"
                                           onclick="set_like(this,<?= $product["id"] ?>,'like')">
                                            <span class="fa  fa-thumbs-o-up like "></span>
                                        </a>
                                        <a href="javascript:void(0)"
                                           onclick="set_like(this,<?= $product["id"] ?>,'dislike')">
                                            <span class="fa  fa-thumbs-o-down dislike"></span>
                                        </a>
                                    </div>
                                    <div class="like">
                                        <a href="javascript:void(0)"
                                           onclick="add_basket(this,<?= $product["id"] ?>)">
                                            <span class="fa fa-cart-plus  add_basket "
                                                  title="افزودن به سبد خرید"></span>
                                        </a>
                                    </div>
                                    <?php
                                    if ($product['likes'] > 0) {
                                        $all_likes = $product['likes'] + $product["dislikes"];
                                        $like_stars = ((($product['likes'] * 100) / $all_likes) / 10) / 2;
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

                        <?php }
                    } else { ?>
                        <p style="padding: 100px 0;font-size: 15px;direction: rtl"> هنوز محصولی به علاقه مندی ها افزوده
                            نشده ... </p>
                    <?php } ?>
                </div>
                <!-- /PRODUCT LIST -->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- /SECTION -->


<script>

    function set_like(item, product_id, param) {
        var url = "<?= SITE_URL ?>ecomm/set_like";
        var data = {"product_id": product_id, "param": param};
        var item_old_class = $(item).find("span").attr("class");
        $(item).find("span").removeClass();
        $(item).find("span").addClass("fa fa-spinner");
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
        $(item).find("span").addClass("fa fa-spinner");
        $.post(url, data, function (msg) {
            if (msg == true) {
                ////
            } else if (msg == "login") {
                swal(" ", "لطفا وارد حساب کاربری شوید ", "warning");
            } else if (msg == "was") {
                swal(" ", "قبلا به لیست مورد علاقه افزوده شده ", "warning");
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
                swal(" ", " ثبت شد", "success");
            } else if (msg == "login") {
                // swal("", "لطفا وارد حساب کاربری شوید", "warning");
                window.location = "<?= SITE_URL ?>users/user_login"
            } else if (msg == "was") {
                // swal("", "قبلا به لیست مورد علاقه افزوده شده ", "warning");
            } else {
                swal(" ", "مشکل در ثبت", "danger");
            }
            $(item).find("span").removeClass();
            $(item).find("span").addClass(item_old_class);
        })
    }

</script>
