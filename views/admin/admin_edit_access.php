<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">ویرایش دسترسی ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">

                        <?php
                        $access = $data["access"];
                        if (!empty($access)) {
                            ?>
                            <?php
                            if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "success") {
                                ?>
                                <div class="alert alert-success alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link">تغییرات با موفقیت بروزرسانی شد</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "danger") {
                                ?>
                                <div class="alert alert-danger alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link"> خطا در بروزرسانی تغییرات !</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "repeat") {
                                ?>
                                <div class="alert alert-warning alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link">نام انگلیسی دسترسی تکراری است</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "is_not_file") {
                                ?>
                                <div class="alert alert-warning alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link">این ایتم دسترسی وجود ندارد !</a>
                                </div>
                            <?php }
                            if (!empty($_SESSION["edit_access"]) and $_SESSION["edit_access"] == "empty") {
                                ?>
                                <div class="alert alert-warning alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
                                    <a class="alert-link"> نام یا نام انگلیسی دسترسی نمیتواند خالی باشد !</a>
                                </div>
                            <?php }
                            unset($_SESSION["edit_access"]) ?>
                            <h4 style="margin: 10px 0 30px 0;"><b> افزودن دسترسی جدید </b></h4>
                            <form action="<?= SITE_URL ?>admin_access/update_access/<?= $access["id"] ?>"
                                  method="post"
                                  enctype="multipart/form-data">
                                <div class="m-t-20">
                                    <h5><b>نام دسترسی</b></h5>
                                    <input required type="text" name="title" class="form-control"
                                           id="thresholdconfig" value="<?= $access["title"] ?>"/>
                                </div>
                                <div class="m-t-20">
                                    <h5><b>نام انگلیسی</b></h5>
                                    <input required type="text" name="EN_name" class="form-control"
                                           id="thresholdconfig" value="<?= $access["EN_name"] ?>"/>
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
