<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت دسترسی ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                            </div>
                        <?php }

                        if (!empty($_SESSION["add_access"]) and $_SESSION["add_access"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">دسترسی جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_access"]) and $_SESSION["add_access"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت دسترسی جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_access"]) and $_SESSION["add_access"] == "repeat") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">نام انگلیسی دسترسی تکراری است</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_access"]) and $_SESSION["add_access"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام یا نام انگلیسی دسترسی نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["add_access"]) and $_SESSION["add_access"] == "is_not_file") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> این ایتم دسترسی وجود ندارد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["edit_access"]);
                        unset($_SESSION["add_access"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> افزودن دسترسی جدید </b></h4>
                        <form action="<?= SITE_URL ?>admin_access/update_access" method="post">
                            <div class="m-t-20">
                                <h5><b>نام دسترسی</b></h5>
                                <input required type="text" name="title" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>نام انگلیسی</b></h5>
                                <input required type="text" name="EN_name" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="checkbox checkbox-custom">
                                <input id="checkbox11" type="checkbox" name="status" checked="">
                                <label for="checkbox11">فعال</label>
                            </div>
                            <div class="m-t-20">
                                <input type="submit" class="form-control btn btn-success" value="ثبت"/>
                            </div>
                        </form>
                        <!-- ************   active error   ******   -->
                        <div class="alert alert-danger alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <a class="alert-link"> با غیر فعال کردن وضعیت دسترسی ، این دسترسی برای کل اعضا حذف میشود !
                            </a>
                        </div>
                        <!-- *************   delete error   ******   -->
                        <div class="alert alert-danger alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <a class="alert-link"> با حذف دسترسی ، این دسترسی برای کل اعضا حذف میشود !</a>
                        </div>

                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>نام انگلیسی</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $all_access = $data["all_access"];
                            foreach ($all_access as $access) {
                                ?>
                                <tr class="active">
                                    <td><?= $access["title"] ?></td>
                                    <td><?= $access["EN_name"] ?></td>

                                    <td class="act_title"><?php if ($access['status'] == 'ACTIVE') {
                                            echo '<span style="color: #00c300"> فعال</span>';
                                        } elseif ($access['status'] == 'INACTIVE') {
                                            echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                        } ?></td>
                                    <td>
                                        <!--                                <a href="#" class="table-action-btn p" title="ویرایش" style="margin: 0 10px">-->
                                        <!--                                    <i class="btn btn-info btn-xs md md-edit"></i></a>-->
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $access['id'] ?>,'inactive',this)"
                                           title="غیر فعال کردن"
                                           class="table-action-btn <?php if ($access['status'] == 'INACTIVE') {
                                               echo 'hidden';
                                           } ?>">
                                            <i class="btn btn-warning btn-xs   fa fa-ban"></i></a>
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $access['id'] ?>,'active',this)"
                                           title=" فعال کردن"
                                           class="table-action-btn <?php if ($access['status'] == 'ACTIVE') {
                                               echo 'hidden';
                                           } ?>">
                                            <i class="btn btn-success btn-xs md md-check "></i></a>
                                        <!-- ========== delete ====== -->
                                        <a style="cursor: pointer"
                                           onclick="delete_category(<?= $access['id'] ?> ,this)"
                                           title="حذف" class="table-action-btn ">
                                            <i class="btn btn-danger btn-xs md md-close "></i></a>
                                    </td>
                                    <td>
                                        <!-- ==========Edit ====== -->
                                        <a href="<?= SITE_URL ?>admin_access/edit_access/<?= $access['id'] ?>"
                                           title="ویرایش"
                                           class="table-action-btn ">
                                            <i class="btn btn-info   btn-xs md md-edit "></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            swal({
                    title: " غیر فعال شود؟",
                    text: "برای همه اعضا این دسترسی حذف میشود !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله",
                    cancelButtonText: "خیر",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var url = "<?= SITE_URL ?>admin_access/access_status_change";
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
                    } else {
                        swal("لغو شد", " ", "error");
                    }
                });
        }

        function delete_category(id, item) {
            swal({
                    title: " حذف شود؟",
                    text: "برای همه اعضا این دسترسی حذف میشود !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله",
                    cancelButtonText: "خیر",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var url = "<?= SITE_URL ?>admin_access/access_delete";
                        var data = {'id': id};
                        $.post(url, data, function (msg) {
                            if (msg == true) {
                                swal('با  موفقیت حذف شد', ' ', 'success');
                                $(item).parents('tr').remove();
                            } else {
                                swal("مشکل در حذف !", " ", "error");
                            }
                        })
                    } else {
                        swal("لغو شد", " ", "error");
                    }
                });
        }

    </script>