<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت منوها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        $menu = $data['menu'];
                        if (!empty($_SESSION["menu_update"]) and $_SESSION["menu_update"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["menu_update"]) and $_SESSION["menu_update"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در بروزرسانی تغییرات !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["menu_update"]) and $_SESSION["menu_update"] == "warning") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> مقادیر نمیتوانند خالی باشد !</a>
                            </div>
                        <?php }


                        if (!empty($_SESSION["menu_save"]) and $_SESSION["menu_save"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["menu_save"]) and $_SESSION["menu_save"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["menu_save"]) and $_SESSION["menu_save"] == "warning") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> مقادیر نمیتوانند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["menu_save"]);
                        unset($_SESSION["menu_update"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> افزودن جدید </b></h4>
                        <form action="<?= SITE_URL ?>admin_panel/insert_menu" method="post"
                              enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام </b></h5>
                                <input required type="text" name="name" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>نام انگلیسی</b></h5>
                                <input required type="text" name="EN_name" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>لینک</b></h5>
                                <input required type="text" name="link" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>

                            <div class="m-t-20">
                                <h5><b> ایکون (تصویر)</b></h5>
                                <input required type="text" name="icon" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>

                            <div class="checkbox checkbox-custom">
                                <input id="checkbox11" type="checkbox" name="status" checked="checked">
                                <label for="checkbox11">فعال</label>
                            </div>
                            <div class="m-t-20">
                                <input type="submit" class="form-control btn btn-success"
                                       value="ثبت"/>
                            </div>
                        </form>

                        <style>
                            table tr.active {

                            }

                            .pointer {
                                cursor: move;
                            }
                        </style>

                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام</th>
                                <th>نام انگلیسی</th>
                                <th> لینک</th>
                                <th> ایکون</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($menu as $key => $item) {
                                ?>
                                <tr class="active" data-id="<?= $item["id"] ?>">
                                    <td><span class="fa  fa-arrows pointer"></span></td>
                                    <!--                                    <td><span>-->
                                    <? //= $key ?><!--</span></td>-->
                                    <td><?= $item["name"] ?></td>
                                    <td><?= $item["EN_name"] ?></td>
                                    <td><?= $item["link"] ?></td>
                                    <td><i class="<?= $item["icon"] ?>"></i></td>
                                    <td class="act_title">
                                        <?php if ($item['status'] == 'ACTIVE') {
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
                                            <i class="btn btn-success btn-xs fa fa-check "></i></a>
                                    </td>
                                    <td>
                                        <!-- ==========Edit ====== -->
                                        <a href="<?= SITE_URL ?>admin_panel/edit_menu/<?= $item['id'] ?>"
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
            var url = "<?= SITE_URL ?>admin_panel/menu_status";
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
            var url = "<?= SITE_URL ?>admin_category/category_delete";
            var data = {'id': id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت حذف شد', ' ', 'success');
                    $(item).parents('tr').remove();
                } else if (msg == "posts") {
                    swal("دسته هایی که دارای مطلب هستند رو نمی توان حذف کرد !", " ", "error");
                } else {
                    swal("مشکل در حذف !", " ", "error");
                }
            })
        }

        $(document).ready(function () {
            $("tbody  ").sortable({
                stop: function (event, ui) {
                    var index = ui.item.index();
                    var item_id = ui.item.attr("data-id");
                    var url = "<?= SITE_URL ?>admin_panel/update_menu_sort";
                    var data = {"index": index, "id": item_id};
                    $.post(url, data, function (msg) {
                        if (msg == "1") {
                            swal("انجام شد", "", "success")
                        } else {
                            swal("مشکل در ثبت ", "", "warning")
                        }
                    })
                }
                // start: function (event, ui) {
                //     var currPos1 = ui.item.index();
                //     alert(currPos1);
                // },
                // change: function (event, ui) {
                //     var currPos2 = ui.item.index();
                //     alert(currPos2);
                // }
            });
        });

    </script>