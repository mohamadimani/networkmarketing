<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت شبکه های اجتماعی</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        $social = $data['social'];
                        if (!empty($_SESSION["social_update"]) and $_SESSION["social_update"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["social_update"]) and $_SESSION["social_update"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در بروزرسانی تغییرات !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["social_update"]) and $_SESSION["social_update"] == "warning") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> مقادیر نمیتوانند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["social_update"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> افزودن جدید </b></h4>
                        <form action="<?= SITE_URL ?>admin_social/update_social/<?= $social["id"] ?>" method="post"
                              enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام </b></h5>
                                <input required type="text" name="name" class="form-control"
                                       id="thresholdconfig" value="<?= @$social["name"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>نام انگلیسی</b></h5>
                                <input required type="text" name="EN_name" class="form-control"
                                       id="thresholdconfig" value="<?= @$social["EN_name"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>لینک</b></h5>
                                <input required type="text" name="link" class="form-control"
                                       id="thresholdconfig" value="<?= @$social["link"] ?>"/>
                            </div>

                            <div class="m-t-20">
                                <h5><b> ایکون (تصویر)</b></h5>
                                <input required type="text" name="icon" class="form-control"
                                       id="thresholdconfig" value="<?= @$social["icon"] ?>"/>
                            </div>

                            <div class="checkbox checkbox-custom">
                                <input id="checkbox11" type="checkbox" name="status" <?php if (@$social["icon"]) {
                                    echo "checked";
                                } ?> >
                                <label for="checkbox11">فعال</label>
                            </div>
                            <div class="m-t-20">
                                <input type="submit" class="form-control btn btn-success"
                                       value="ثبت"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_social/social_status";
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

    </script>