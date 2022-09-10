<?php
$projects = $data['projects'];
?>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت پروژه ها </h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        if (!empty($_SESSION["edit_projects"]) and $_SESSION["edit_projects"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">پروژه جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_projects"]) and $_SESSION["edit_projects"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت پروژه جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_projects"]) and $_SESSION["edit_projects"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام پروژه نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        //                        unset($_SESSION["edit_category"]);
                        unset($_SESSION["edit_projects"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> افزودن پروژه جدید </b></h4>
                        <form action="<?= SITE_URL ?>admin_projects/update_project/<?= $projects["id"] ?>" method="post"
                              enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام مشتری </b></h5>
                                <input required type="text" name="client" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["client"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>نام پروژه </b></h5>
                                <input required type="text" name="title" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["title"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b> توضیحات </b></h5>
                                <input required type="text" name="introduction" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["introduction"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>تاریخ شروع </b></h5>
                                <input required type="text" name="start" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["start"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>تاریخ اتمام </b></h5>
                                <input required type="text" name="finish" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["finish"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b> درصد پیشرفت </b></h5>
                                <input required type="text" name="progress" class="form-control"
                                       id="thresholdconfig" value="<?= $projects["progress"] ?>"/>
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


                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_projects/project_status_change";
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
            var url = "<?= SITE_URL ?>admin_gallery_category/category_delete";
            var data = {'id': id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت حذف شد', ' ', 'success');
                    $(item).parents('tr').remove();
                } else if (msg == "posts") {
                    swal("پروژه  هایی که دارای عکس هستند رو نمی توان حذف کرد !", " ", "error");
                } else {
                    swal("مشکل در حذف !", " ", "error");
                }
            })
        }

    </script>