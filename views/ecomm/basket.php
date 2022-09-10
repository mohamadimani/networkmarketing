<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 03/10/2019
 * Time: 03:44 PM
 */

$basket = $data["basket_info"];
?>

<style>
    .f_right {
        float: right;
    }

    .font-15 {
        font-size: 15px !important;
    }

    .no_item {
        width: 100%;
        float: right;
        text-align: center;
        font-size: 17px;
        color: #ff3c15;
        margin-top: 20px;
        background-color: rgba(255, 54, 59, 0.1);
        padding: 10px;
        direction: rtl;
    }

    span.checkbox {
        box-shadow: 1px 1px 2px 1px silver;
        border: 1px solid #dedede ;
        background-color: #eeeeee ;
    }

    .cart-total {
        height: 40px !important;
    }

    .cart-total p {
        line-height: 40px !important;
    }

    .cart .cart-item:nth-child(odd) {
        padding: 5px 0 0 !important;
        background-color: rgba(238, 238, 238, 0.29);
    }

    .cart .cart-item:nth-child(even) {
        padding: 5px 0 0 !important;
        background-color: rgba(238, 238, 238, 0.29);
    }


</style>
<!-- SECTION -->
<div class="section-wrap">
    <div class="section" style="padding: 50px 0 300px;">

        <!-- CONTENT -->
        <div class="content left">
            <!-- CART -->
            <div class="cart">
                <!-- CART HEADER -->

                <div class="cart-header">
                    <div class="cart-header-product">
                        <p class="text-header small"> نام محصول</p>
                    </div>
                    <div class="cart-header-category">
                        <p class="text-header small">تعداد</p>
                    </div>
                    <div class="cart-header-price">
                        <p class="text-header small">قیمت هرعدد</p>
                    </div>
                    <div class="cart-header-actions">
                        <p class="text-header small">حذف</p>
                    </div>
                </div>
                <?php
                if (is_array($basket)) {
                    $sum_prices = 0;
                    $sum_discounts = 0;
                    foreach ($basket as $key => $item) {
                        $sum_price[$key] = ($item["price"] * $item["count"]);
                        $sum_discount[$key] = ceil(($sum_price[$key] * $item["discount"]) / 100);
                        $sum_prices += $sum_price[$key];
                        $sum_discounts += $sum_discount[$key];
                        ?>
                        <div class="cart-item">
                            <!-- CART ITEM PRODUCT -->
                            <div class="cart-item-product">
                                <!-- ITEM PREVIEW -->
                                <div class="item-preview">
                                    <a>
                                        <figure class="product-preview-image small liquid">
                                            <img src="<?= SITE_URL ?>public/product/<?= $item["product_id"] ?>/gallery/s/<?= $item["image"] ?>">
                                        </figure>
                                    </a>
                                    <a><p class="text-header small font-15"><?= $item["name"] ?></p></a>
                                    <p class="description"><?= $item["summary"] ?></p>
                                </div>
                                <!-- /ITEM PREVIEW -->
                            </div>
                            <div class="cart-item-category" style="text-align: right!important;">
                                <a class="category primary font-15"><?= $item["count"] ?></a>
                            </div>
                            <div class="cart-item-price">
                                <p class="price f_right "><span class="f_right font-15">تومان</span>
                                    <span class="f_right font-15"><?= $item["price"] ?></span></p>
                            </div>
                            <div class="cart-item-actions">
                                <a href="<?= SITE_URL ?>ecomm/remode_basket_item/<?= $item["id"] ?>"
                                   class="button  f_right  rmv">
                                    <span class="fa fa-close  btn btn-danger"></span>
                                </a>
                            </div>
                            <!-- /CART ITEM ACTIONS -->
                        </div>
                    <?php } ?>

                    <!-- CART TOTAL -->
                    <div class="cart-total">
                        <p class="price"><span>تومان</span><?= $sum_prices ?></p>
                        <p class="text-header total">جمع سبد خرید </p>
                    </div>
                    <!-- /CART TOTAL -->

                    <!-- CART TOTAL -->
                    <div class="cart-total">
                        <p class="price"><span>تومان</span><?= $sum_discounts ?></p>
                        <p class="text-header total">تخفیف</p>
                    </div>
                    <!-- /CART TOTAL -->
                    <div class="cart-total">
                        <p class="price "><span>تومان</span><?= $sum_prices - $sum_discounts ?></p>
                        <p class="text-header total">مبلغ فاکتور </p>
                    </div>
                    <!-- /CART TOTAL -->
                    <div class="cart-actions" style="padding: 50px 0 3px 80px;">
                        <!-- CHECKBOX -->
                        <input type="checkbox" id="law" name="law" onclick="show_pay(this)">
                        <label for="law" style="float: left;" class="label-check"> ‍‍‍ پذیرش
                            <a href="<?= SITE_URL ?>ecomm/law" target="_blank">قوانین ، امضاء قرارداد</a> وخرید محصول
                            <span class="checkbox primary "
                                  style="margin-top:0!important;top: 0!important; "><span></span></span>
                        </label>
                        <!-- /CHECKBOX -->

                    </div>
                    <!-- CART ACTIONS -->
                    <!--                    <hr style="margin: 0!important;">-->
                    <div class="cart-actions">
                        <a href="<?= SITE_URL ?>ecomm/checkout" class="button mid primary" style="display: none">
                            پرداخت </a>
                        <a href="<?= SITE_URL ?>ecomm" class="button mid dark-light spaced">ادامه خرید </a>
                    </div>
                <?php } else {
                    ?>
                    <p class="no_item">هیچ محصولی در سبد شما یافت نشد!</p>
                <?php } ?>
                <!-- /CART ACTIONS -->
            </div>
            <!-- /CART -->
        </div>
        <!-- CONTENT -->
    </div>
</div>
<!-- /SECTION -->

<style>
    p.lead.text-muted {
        margin-top: 30px !important;
    }
</style>
<script>
    function show_pay(item) {
        if ($(item).prop('checked')) {
            // swal(" ", "انتخاب این گزینه به منزله قبول قرارداد فروش سایت میباشد ", "success");
            $("div.cart-actions a.primary").css({"display": "inline-block"})
        } else {
            $("div.cart-actions a.primary").css({"display": "none"})
        }
    }
</script>

