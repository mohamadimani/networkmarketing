<?php
$all_orders = $data["all_orders"];
?>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title m-b-30">لیست محصولات</h4>
                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="card-box">

                            <div class="table-responsive">
                                <table class="table table-actions-bar">
                                    <thead>
                                    <tr>
                                        <th>شماره فاکتور</th>
                                        <th>تعداد محصول</th>
                                        <th>نام خریدار</th>
                                        <th> مبلغ فاکتور</th>
                                        <th>وضعیت فاکتور</th>
                                        <th>وضعیت پرداخت</th>
                                        <th>تاریخ</th>
                                        <th>مشاهده محصولات</th>
                                        <th>مشاهده فاکتور</th>
                                        <th style="min-width: 80px;">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody class="products">
                                    <?php foreach ($all_orders as $order) { ?>
                                        <tr>
                                            <td><?= $order["factor_number"] ?></td>
                                            <td><?= $order["product_count"] ?></td>
                                            <td><?= $order["user_name"] ?></td>
                                            <td><span> <?= $order["amount"] ?> </span><span> تومان </span></td>
                                            <td class="act_title"><?php if ($order['status'] == 'ACTIVE') {
                                                    echo '<span style="color: #00c300"> فعال</span>';
                                                } elseif ($order['status'] == 'INACTIVE') {
                                                    echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                                } ?>
                                            </td>
                                            <td><?php if ($order['pay_status'] == 'PAID') {
                                                    echo '<span style="color: #00c300"> پرداخت شده</span>';
                                                } elseif ($order['pay_status'] == 'UNPAID') {
                                                    echo '<span style="color: #ff0e0e">پرداخت نشده</span>';
                                                } ?>
                                            </td>
                                            <td><?= $order["date"] ?></td>
                                            <td>
                                                <a href="<?= SITE_URL ?>admin_ecomm_orders/factor_products_list/<?= $order["id"] ?>">
                                                    <i class="fa fa-eye"></i></a></td>
                                            <td>
                                                <a href="<?= SITE_URL ?>admin_ecomm_orders/print_factor/<?= $order["id"] ?>">
                                                    <i class="fa fa-eye"></i></a></td>
                                            <td><a style="cursor: pointer"
                                                   onclick="active_factor(<?= $order['id'] ?>,'inactive',this)"
                                                   title="غیر فعال کردن"
                                                   class="table-action-btn <?php if ($order['status'] == 'INACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-warning btn-xs   fa fa-ban"></i></a>
                                                <a style="cursor: pointer"
                                                   onclick="active_factor(<?= $order['id'] ?>,'active',this)"
                                                   title=" فعال کردن"
                                                   class="table-action-btn <?php if ($order['status'] == 'ACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-success btn-xs md md-check "></i></a>
                                                <!-- ========== delete ====== -->
                                                <a href="<?= SITE_URL ?>admin_ecomm_products/edit_product/<?= $product['id'] ?>"
                                                   style="cursor: pointer" title="ویرایش" class="table-action-btn ">
                                                    <i class="btn btn-info btn-xs md md md-edit "></i></a>
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

        function active_factor(id, status, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_orders/orders_status_change";
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

    </script>