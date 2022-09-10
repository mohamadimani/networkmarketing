<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 03/18/2019
 * Time: 10:33 AM
 */
$orders = $data["orders"];
?>

<style>
    table.purchases-list {
        width: 100%;
        float: right;
        direction: rtl;
        text-align: right;
    }

    table.purchases-list tr {
        direction: rtl;
        padding: 5px 10px;

    }

    table.purchases-list th, table.purchases-list td {
        direction: rtl;
        padding: 5px 10px;

    }

    thead {
        border-bottom: 2px solid #9e9e9e !important;
    }

    .price {
        font-size: 13px !important;
    }

    .success {
        width: 100%;
        padding: 10px 0;
        margin: 10px 0;
        font-size: 16px;
        text-align: center;
        color: #6ac668;
        background-color: rgba(148, 253, 146, 0.33);
        border-radius: 5px;
        direction: rtl;
    }

    .errore {
        width: 100%;
        padding: 10px 0;
        margin: 10px 0;
        font-size: 16px;
        text-align: center;
        border-radius: 5px;
        color: #ff4d54;
        background-color: rgba(255, 83, 83, 0.24);
        direction: rtl;
    }

    .no_item {
        width: 100%;
        float: right;
        text-align: center;
        font-size: 17px;
        color: #ff3c15;
        background-color: rgba(255, 54, 59, 0.1);
        padding: 10px 0;
        margin: 20px 0;
        direction: rtl;
    }
</style>
<!-- DASHBOARD BODY -->
<div class="dashboard-body" style="padding: 20px ">

    <!-- DASHBOARD CONTENT -->
    <div class="dashboard-content">
        <?php
        if (!empty($_SESSION["user_pay"]) and $_SESSION["user_pay"] == "success") {
            ?>
            <p class="success">پرداخت با موفقیت انجام شد</p>
        <?php }
        if (!empty($_SESSION["user_pay"]) and $_SESSION["user_pay"] == "connect") {
            ?>
            <p class="errore">مشکل در اتصال به درگاه پرداخت</p>
        <?php }
        if (!empty($_SESSION["user_pay"]) and $_SESSION["user_pay"] == "danger") {
            ?>
            <p class="errore"><span><?= $_SESSION["user_error"] ?></span></p>
        <?php }
        unset($_SESSION["user_error"]);
        unset($_SESSION["user_pay"]);
        ?>
        <table class="purchases-list">
            <thead>
            <tr>
                <th><p>تاریخ </p></th>
                <th><p>شماره فاکتور </p></th>
                <th><p>تعداد محصول </p></th>
                <th><p>نام خریدار </p></th>
                <th><p> مبلغ فاکتور </p></th>
                <th><p>وضعیت فاکتور </p></th>
                <th><p>وضعیت پرداخت </p></th>
                <!--                <th><p>مشاهده محصولات </p></th>-->
                <th style="min-width: 80px;"><p>عملیات </p></th>
            </tr>
            </thead>
            <tbody>

            <?php if (is_array($orders)) {
                foreach ($orders as $order) { ?>
                    <tr class=" ">
                        <td class=" ">
                            <p class="price"><?= $order["date"] ?></p>
                        </td>
                        <td class=" ">
                            <p class="price"><?= $order["factor_number"] ?></p>
                        </td>
                        <td class=" ">
                            <p class="  price  "><?= $order["product_count"] ?></p>
                        </td>
                        <td class="  ">
                            <p class="price" style="direction: rtl">
                                <?= $order["user_name"] ?>
                            </p>
                        </td>
                        <td class="  ">
                            <p class="price" style="direction: rtl">
                                <span class="price"> <?= $order["amount"] ?> </span> <span
                                        class="price"> تـومـان  </span>
                            </p>
                        </td>
                        <td class="act_title"><?php if ($order['status'] == 'ACTIVE') {
                                echo '<p class="price" style="color: #00c300"> فعال</p>';
                            } elseif ($order['status'] == 'INACTIVE') {
                                echo '<p class="price" style="color: #ff0e0e">غیر فعال</p>';
                            } ?>
                        </td>
                        <td class="act_title"><?php if ($order['pay_status'] == 'PAID') {
                                echo '<p class="price" style="color: #00c300"> پرداخت شده</p>';
                            } elseif ($order['pay_status'] == 'UNPAID') {
                                echo '<p class="price" style="color: #ff0e0e">  پرداخت نشده</p>';
                            } ?>
                        </td>
                        <!--                    <td style="text-align: center">-->
                        <!--                        <a href="--><? //= SITE_URL ?><!--users/order_product/-->
                        <? //= $order["id"] ?><!--">-->
                        <!--                            <i class="sl-icon icon-eye"></i>-->
                        <!--                        </a>-->
                        <!--                    </td>-->
                        <td style="text-align: center">
                            <?php if ($order['pay_status'] == 'PAID') {
                                ?>
                            <?php } elseif ($order['pay_status'] == 'UNPAID') { ?>
                                <a class="button small secondary" style="width: 60px;"
                                   href="<?= SITE_URL ?>ecomm/checkout/<?= $order["id"] ?>">
                                    پرداخت</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <p class="no_item">هیچ سفارشی به نام شما یافت نشد!</p>
            <?php } ?>
            </tbody>
        </table>
        <!-- /PURCHASES LIST -->
    </div>
    <!-- DASHBOARD CONTENT -->
</div>
<!-- /DASHBOARD BODY -->

