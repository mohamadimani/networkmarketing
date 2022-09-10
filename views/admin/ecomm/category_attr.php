<?php
$attrs = $data['attrs'];
if (!empty($data["attr_info"])) {
    $attr_info = $data['attr_info'];
}
?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت ویژگی های دسته بندی </h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        if (!empty($_SESSION["edit_category_attr"]) and $_SESSION["edit_category_attr"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_category_attr"]) and $_SESSION["add_category_attr"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">ویژگی جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_category_attr"]) and $_SESSION["add_category_attr"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت ویژگی جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_category_attr"]) and $_SESSION["add_category_attr"] == "warning") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">نام ویژگی تکراری است</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_category_attr"]) and $_SESSION["add_category_attr"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام ویژگی نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["edit_category_attr"]);
                        unset($_SESSION["add_category_attr"]);
                        if (empty($attr_info)) {
                            ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن ویژگی اصلی جدید </b>
                                <a href="<?= SITE_URL ?>admin_ecomm_product_category/index/<?= $data["cat_parent"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a></h4>
                        <?php } elseif ($attr_info["parent"] == 0) { ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن زیر ویژگی برای (<span
                                            style="color: #ff3c15;"><?= $attr_info["title"] ?></span>)
                                </b>
                                <a href="<?= SITE_URL ?>admin_ecomm_product_category/attr/<?= $attr_info["category_id"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i></span></a></h4>
                        <?php } else { ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن زیر ویژگی برای (<span
                                            style="color: #ff3c15;"><?= $attr_info["title"] ?></span>)
                                </b>
                                <a href="<?= SITE_URL ?>admin_ecomm_product_category/attr/0/<?= $attr_info["parent"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i></span></a></h4>
                        <?php }
                        if (!empty($data["attr_id"])) {
                            $attr_id = $data["attr_id"];
                        } else {
                            $attr_id = 0;
                        }
                        if (!empty($data["cat_id"])) {
                            $cat_id = $data["cat_id"];
                        }
                        if (!empty($attr_info["category_id"])) {
                            $cat_id = $attr_info["category_id"];
                        }
                        ?>

                        <form action="<?= SITE_URL ?>admin_ecomm_product_category/add_attr/<?= $cat_id ?>/<?= $attr_id ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام ویژگی</b></h5>
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
                                <th>نام ویژگی</th>
                                <th>مشاهده زیر ویژگی</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($attrs as $item) {
                                ?>
                                <tr class="active">
                                    <td><?= $item["title"] ?></td>
                                    <td>
                                        <a href="<?= SITE_URL ?>admin_ecomm_product_category/attr/0/<?= $item["id"] ?>">
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
                                        <!-- ========== Edit ====== -->
                                        <a href="<?= SITE_URL ?>admin_ecomm_product_category/edit_attr/<?= $item['id'] ?>"
                                           title="ویرایش" class="table-action-btn ">
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
            var url = "<?= SITE_URL ?>admin_ecomm_product_category/attr_status_change";
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
            var url = "<?= SITE_URL ?>admin_ecomm_product_category/delete_attr";
            var data = {'id': id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت حذف شد', ' ', 'success');
                    $(item).parents('tr').remove();
                } else if (msg == 2) {
                    swal("ویژگی هایی که دارای زیر ویژگی هستند رو نمی توان حذف کرد !", " ", "error");
                } else {
                    swal("مشکل در حذف !", " ", "error");
                }
            })
        }

    </script>
