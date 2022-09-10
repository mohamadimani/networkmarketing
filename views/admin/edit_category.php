<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">ویرایش مجموعه ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">

                        <?php
                        $category = $data["category"];
                        if (!empty($category)) {
                            ?>
                            <?php
                            if (!empty($_SESSION["edit_category"]) and $_SESSION["edit_category"] == "success") {
                                ?>
                                <div class="alert alert-success alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_category"]) and $_SESSION["edit_category"] == "danger") {
                                ?>
                                <div class="alert alert-danger alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link"> خطا در بروزرسانی تغییرات !</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_category"]) and $_SESSION["edit_category"] == "warning") {
                                ?>
                                <div class="alert alert-warning alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link">نام انگلیسی مجموعه تکراری است</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_category"]) and $_SESSION["edit_category"] == "empty") {
                                ?>
                                <div class="alert alert-warning alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link"> نام یا نام انگلیسی مجموعه نمیتواند خالی باشد !</a>
                                </div>
                            <?php } ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن مجموعه جدید </b></h4>
                            <form action="<?= SITE_URL ?>admin_category/save_category/<?= $category["id"] ?>"
                                  method="post"
                                  enctype="multipart/form-data">
                                <div class="m-t-20">
                                    <h5><b>نام مجموعه</b></h5>
                                    <input required type="text" name="name" class="form-control"
                                           id="thresholdconfig" value="<?= $category["name"] ?>"/>
                                </div>
                                <div class="m-t-20">
                                    <h5><b>نام انگلیسی</b></h5>
                                    <input required type="text" name="EN_name" class="form-control"
                                           id="thresholdconfig" value="<?= $category["EN_name"] ?>"/>
                                </div>
                                <div class="m-t-20">
                                    <h5><b> تعداد پست های مجاز</b></h5>
                                    <input required type="number" name="post_count" class="form-control"
                                           id="thresholdconfig" value="<?= $category["post_count"] ?>"/>
                                </div>
                                <div class="m-t-20">
                                    <input type="submit" class="form-control btn btn-success"
                                           value="ثبت"/>
                                </div>
                            </form>
                        <?php } else {
                            ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> مشکل در بارگزاری صفحه! مجدد تلاش کنید </b></h4>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_category/category_status_change";
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