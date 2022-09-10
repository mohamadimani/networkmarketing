<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت دسته بندی ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        $categorys = $data["categorys"];
                        $cat_info = $data["cat_info"];
                        if (!empty($_SESSION["edit_product_category"]) and $_SESSION["edit_product_category"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">دسته جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_product_category"]) and $_SESSION["edit_product_category"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت دسته جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_product_category"]) and $_SESSION["edit_product_category"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام دسته بندی نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["edit_product_category"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;"><b> ویرایش دسته </b>
                            <a href="<?= SITE_URL ?>admin_ecomm_product_category/index/<?= $cat_info["parent"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a>
                        </h4>
                        <form action="<?= SITE_URL ?>admin_ecomm_product_category/update_category/<?= $cat_info["id"] ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام دسته</b></h5>
                                <input required type="text" name="name" class="form-control"
                                       id="thresholdconfig" value="<?= $cat_info["title"] ?>"/>
                            </div>
                            <div class="m-t-20">
                                <h5><b>انتخاب والد</b></h5>
                                <select required type="text" name="parent" class="form-control"
                                        id="thresholdconfig">
                                    <option value="<?= $cat_info["parent"] ?>"> بدون تغییر</option>
                                    <option value="0">بدون والد</option>
                                    <?php
                                    foreach ($categorys as $category) {
                                        $select = "";
                                        if ($category["id"] == $cat_info["parent"]) {
                                            $select = "selected";
                                        }
                                        if ($category["id"] == $cat_info["id"]) {
                                            continue;
                                        }
                                        ?>
                                        <option value="<?= $category["id"] ?>" <?= $select ?>> <?= $category["title"] ?></option>
                                    <?php } ?>
                                </select>
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

