<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت مطالب</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-box">

                        <?php
                        if (!empty($_SESSION["save_post"]) and $_SESSION["save_post"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <a class="alert-link">پست جدید با موفقیت ذخیره شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["update_post"]) and $_SESSION["update_post"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×
                                </button>
                                <a class="alert-link">پست با موفقیت بروز رسانی شد</a>
                            </div>
                        <?php }
                        unset($_SESSION["save_post"]);
                        unset($_SESSION["update_post"]); ?>

                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th> متن پست</th>
                                <th>نام مجموعه</th>
                                <th>تعداد بازدید</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $site_posts = $data['site_posts'];
                            foreach ($site_posts as $item) {
                                ?>
                                <tr class="active">
                                    <td><?= $item["title"] ?></td>
                                    <td><?= $item["content"] ?></td>
                                    <td><?= $item["name"] ?></td>
                                    <td><?= $item["view_count"] ?></td>
                                    <td><?= $item["date"] ?></td>
                                    <td class="act_title"><?php if ($item['status'] == 'ACTIVE') {
                                            echo '<span style="color: #00c300"> فعال</span>';
                                        } elseif ($item['status'] == 'INACTIVE') {
                                            echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $item['id'] ?>,'inactive',this)"
                                           title="غیر فعال کردن"
                                           class="table-action-btn <?php if ($item['status'] == 'INACTIVE') {
                                               echo 'hidden';
                                           } ?>">
                                            <i class="btn btn-warning btn-xs   md md-dnd-on"></i></a>
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
                                        <a href="<?= SITE_URL ?>admin_posts/edit_post/<?= $item['id'] ?>"
                                           title="ویرایش"
                                           class="table-action-btn ">
                                            <i class="btn btn-info   btn-xs md md-edit "></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_posts/post_status_change";
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
            var url = "<?= SITE_URL ?>admin_posts/post_status_change";
            var data = {'id': id, "status": "delete"};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت حذف شد', ' ', 'success');
                    $(item).parents('tr').remove();
                } else {
                    swal("مشکل در حذف !", " ", "error");
                }
            })
        }

    </script>
