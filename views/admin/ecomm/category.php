﻿<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت دسته بندی ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        if (!empty($_SESSION["edit_product_category"]) and $_SESSION["edit_product_category"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                            </div>
                        <?php }


                        if (!empty($_SESSION["add_product_category"]) and $_SESSION["add_product_category"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">دسته جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_product_category"]) and $_SESSION["add_product_category"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت دسته جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_product_category"]) and $_SESSION["add_product_category"] == "warning") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">نام دسته تکراری است</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_product_category"]) and $_SESSION["add_product_category"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام دسته بندی نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["edit_product_category"]);
                        unset($_SESSION["add_product_category"]);

                        if (empty($data["category_id"])) {
                            ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن دسته اصلی جدید </b></h4>
                        <?php } else if (!empty($data["category_id"])) { ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن زیر دسته به (
                                    <span style="color: #ff3c15"><?= $data["cat_info"]["title"] ?></span>)</b>
                                <a href="<?= SITE_URL ?>admin_ecomm_product_category/index/<?= $data["cat_info"]["parent"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a></h4>
                        <?php }
                        if (!empty($data["category_id"])) {
                            $cat_id = $data["category_id"];
                        } elseif (empty($data["category_id"])) {
                            $cat_id = 0;
                        } ?>
                        <form action="<?= SITE_URL ?>admin_ecomm_product_category/add_category/<?= $cat_id ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام دسته</b></h5>
                                <input required type="text" name="name" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="checkbox checkbox-custom">
                                <input id="checkbox11" type="checkbox" name="status" checked="">
                                <label for="checkbox11">فعال</label>
                            </div>
                            <div class="m-t-20">
                                <input type="submit" class="form-control btn btn-success"
                                       value="ثبت"/>
                            </div>
                        </form>

                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>نام دسته</th>
                                <th>مشاهده زیر دسته</th>
                                <th>مشاهده ویژگی</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $categorys = $data['categorys'];
                            foreach ($categorys as $item) {
                                ?>
                                <tr class="active">
                                    <td><?= $item["title"] ?></td>
                                    <td>
                                        <a href="<?= SITE_URL ?>admin_ecomm_product_category/index/<?= $item["id"] ?>">
                                            <i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="<?= SITE_URL ?>admin_ecomm_product_category/attr/<?= $item["id"] ?>">
                                            <i class="fa fa-eye"></i></a>
                                    </td>
                                    <td class="act_title"><?php if ($item['status'] == 'ACTIVE') {
                                            echo '<span style="color: #00c300"> فعال</span>';
                                        } elseif ($item['status'] == 'INACTIVE') {
                                            echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                        } ?></td>
                                    <td>
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $item['id'] ?>,'inactive',this)"
                                           title="غیر فعال کردن"
                                           class="table-action-btn <?php if ($item['status'] == 'INACTIVE') {
                                               echo 'hidden';
                                           } ?>">
                                            <i class="btn btn-warning btn-xs   fa fa-ban"></i></a>
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $item['id'] ?>,'active',this)"
                                           title=" فعال کردن"
                                           class="table-action-btn <?php if ($item['status'] == 'ACTIVE') {
                                               echo 'hidden';
                                           } ?>">
                                            <i class="btn btn-success btn-xs md md-check "></i></a>
                                        <!-- ========== delete ====== -->
                                        <a style="cursor: pointer"
                                           onclick="delete_category(<?= $item['id'] ?>,this)"
                                           title="حذف"
                                           class="table-action-btn ">
                                            <i class="btn btn-danger btn-xs md md-close "></i></a>
                                    </td>
                                    <td>
                                        <!-- ==========Edit ====== -->
                                        <a href="<?= SITE_URL ?>admin_ecomm_product_category/edit_category/<?= $item['id'] ?>"
                                           title="ویرایش"
                                           class="table-action-btn ">
                                            <i class="btn btn-info   btn-xs md md-edit "></i></a>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_product_category/category_status_change";
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

        function delete_category(id, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_product_category/delete_category";
            var data = {'id': id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت حذف شد', ' ', 'success');
                    $(item).parents('tr').remove();
                } else if (msg == 2) {
                    swal("دسته هایی که دارای زیر دسته یا محصول هستند رو نمی توان حذف کرد !", " ", "error");
                } else {
                    swal("مشکل در حذف !", " ", "error");
                }
            })
        }

    </script>
