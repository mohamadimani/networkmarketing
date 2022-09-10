<?php
$factor_products = $data["factor_products"];
?>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title m-b-30">لیست محصولات فاکتور <span
                                style="color: #ff3c15">(<?= $factor_products[0]["factor_number"] ?>
                            )</span>خریدار <span style="color: #ff3c15">(<?= $factor_products[0]["user_name"] ?>)</span>
                    </h4>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 style="text-align: left">
                                <a href="<?= SITE_URL ?>admin_ecomm_orders"><span class="btn btn-success " style="">بازگشت</span></a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-actions-bar" style=" ">
                                    <thead>
                                    <tr>
                                        <th>محصول</th>
                                        <th>قیمت</th>
                                        <th>تعداد</th>
                                        <th>تخفیف</th>
                                        <th>وضعیت</th>
                                        <th style="min-width: 80px;">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody class="products">
                                    <?php foreach ($factor_products as $product) { ?>
                                        <tr>
                                            <td><?= $product["product_name"] ?></td>
                                            <td><span> <?= $product["price"] ?> </span><span> تومان </span></td>
                                            <?php if ($product["pay_status"] == "PAID") { ?>
                                                <td><span><?= $product["count"] ?></span></td>
                                                <td><span><?= $product["discount"] ?></span></td>
                                            <?php } else if ($product["pay_status"] == "UNPAID") { ?>
                                                <td><input name="count" onblur="set_count(this,<?= $product["id"] ?>)"
                                                           value='<?= $product["count"] ?>' min="1" max="10"
                                                           type="number"/>
                                                </td>
                                                <td><input name="discount" value='<?= $product["discount"] ?>'
                                                           onblur="set_discount(this,<?= $product["id"] ?>)"
                                                           min="1" max="90" type="number"/>
                                                </td>
                                            <?php } ?>
                                            <td class="act_title"><?php if ($product['product_status'] == 'ACTIVE') {
                                                    echo '<span style="color: #00c300"> فعال</span>';
                                                } elseif ($product['product_status'] == 'INACTIVE') {
                                                    echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                                } ?></td>
                                            <td><a style="cursor: pointer"
                                                   onclick="active_user(<?= $product['id'] ?>,'inactive',this)"
                                                   title="غیر فعال کردن"
                                                   class="table-action-btn <?php if ($product['product_status'] == 'INACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-warning btn-xs   fa fa-ban"></i></a>
                                                <a style="cursor: pointer"
                                                   onclick="active_user(<?= $product['id'] ?>,'active',this)"
                                                   title=" فعال کردن"
                                                   class="table-action-btn <?php if ($product['product_status'] == 'ACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-success btn-xs md md-check "></i></a>
                                                <!-- ========== delete ====== -->
                                                <!--                                                <a href="-->
                                                <? //= SITE_URL ?><!--admin_ecomm_products/edit_product/-->
                                                <? //= $product['id'] ?><!--"-->
                                                <!--  style="cursor: pointer" title="ویرایش" class="table-action-btn ">-->
                                                <!-- <i class="btn btn-info btn-xs md md md-edit "></i></a>-->
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- end col -->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_orders/factor_product_status_change";
            var data = {'id': id, 'status': status};
            var act_title = '';
            var act_color = '';
            if (status == 'active') {
                act_title = 'فعال';
                act_color = '#00c300';
            } else if (status == 'inactive') {
                act_title = 'غیر فعال';
                act_color = 'red';
            }
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت ثبت شد', ' ', 'success');
                    $(item).parents('td').find('a.hidden').removeClass('hidden');
                    $(item).parents('tr').find('td.act_title').text(act_title);
                    $(item).parents('tr').find('td.act_title').css({'color': act_color});
                    $(item).addClass('hidden');
                } else {
                    swal("مشکل در ثبت !", " ", "error");
                }
            })
        }

        function set_count(item, id) {
            var item_value = $(item).val();
            var url = "<?= SITE_URL ?>admin_ecomm_orders/set_count";
            var data = {"value": item_value, "id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("لینک ذخیره شد ", " ", "success");
                } else {
                    swal("مشکل در سیستم ذخیره", " ", "danger");
                }

            })
        }

        function set_discount(item, id) {
            var item_value = $(item).val();
            var url = "<?= SITE_URL ?>admin_ecomm_orders/set_discount";
            var data = {"value": item_value, "id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("لینک ذخیره شد ", " ", "success");
                } else {
                    swal("مشکل در سیستم ذخیره", " ", "danger");
                }

            })
        }


    </script>