<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">تغییر رمز ورود</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">

                        <?php
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link">رمز ورود با تغییر یافت </a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link"> خطا در ثبت !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "old_pass") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link"> رمز ورود قبلی صحیح نمیباشد !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "repeat_old_new") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link"> رمز ورود جدید با رمز ورود قبلی تکراری است</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "repeat_new") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link"> رمز ورود جدید با تکرار رمز ورود جدید یکی نیست</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["change_password"]) and $_SESSION["change_password"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <a class="alert-link"> مقادیر نمیتوانند خالی باشند !</a>
                            </div>
                        <?php }
                        unset($_SESSION["change_password"]); ?>
                        <form action="<?= SITE_URL ?>admin_password_change/save_password"
                              method="post"
                              enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b> رمز ورود قبلی</b></h5>
                                <input autofocus required type="text" name="old_password" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="m-t-20">
                                <h5><b> رمز ورود جدید</b></h5>
                                <input minlength="6" required type="text" name="new_password" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>تکرار رمز ورود جدید</b></h5>
                                <input minlength="6" required type="text" name="re_new_password" class="form-control"
                                       id="thresholdconfig" value=""/>
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

        function change_password(id, status, item) {
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


    </script>