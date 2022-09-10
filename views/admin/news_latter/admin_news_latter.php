<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت خبرنامه ها </h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php

                        if (!empty($_SESSION["send_email"]) and $_SESSION["send_email"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">خبرنامه با موفقیت ارسال شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["send_email"]) and $_SESSION["send_email"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ارسال خبرنامه !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["send_email"]) and $_SESSION["send_email"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> متن خبرنامه نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        //                        unset($_SESSION["edit_category"]);
                        unset($_SESSION["send_email"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> ارسال خبرنامه </b></h4>
                        <form action="<?= SITE_URL ?>admin_panel/send_email" method="post"
                              enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b> متن خبرنامه</b></h5>
                                <input required type="text" name="letter" class="form-control"
                                       id="thresholdconfig" value=""/>
                            </div>

                            <div class="m-t-20">
                                <input type="submit" class="form-control btn btn-success"
                                       value="ارسال به همه"/>
                            </div>
                        </form>

                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>نام</th>
                                <th>حذف</th>
                                <!--                                <th>ویرایش</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $emails = $data['emails'];
                            foreach ($emails as $item) {
                                ?>
                                <tr class="active">
                                    <td><?= $item["email"] ?></td>
                                    <td>
                                        <!-- ========== Delete ====== -->
                                        <a style="cursor: pointer"
                                           onclick="delete_category(<?= $item['id'] ?>,this)"
                                           title="حذف"
                                           class="table-action-btn ">
                                            <i class="btn btn-danger btn-xs md md-close "></i></a>
                                    </td>
                                    <td>
                                        <!-- ========== Edit ====== -->

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

        function send_email(email, text) {
            var url = "<?= SITE_URL ?>admin_panel/delete_email";
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
            var url = "<?= SITE_URL ?>admin_panel/delete_email";
            var data = {'email_id': id};
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