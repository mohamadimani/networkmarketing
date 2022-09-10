<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">ویرایش ویژگی ها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card-box">
                        <?php
                        $attrs = $data["attrs"];
                        if (!empty($_SESSION["edit_category_attr"]) and $_SESSION["edit_category_attr"] == "success") {
                            ?>
                            <div class="alert alert-success alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link">ویژگی جدید با موفقیت افزوده شد</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_category_attr"]) and $_SESSION["edit_category_attr"] == "danger") {
                            ?>
                            <div class="alert alert-danger alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> خطا در ثبت ویژگی جدید !</a>
                            </div>
                        <?php }
                        if (!empty($_SESSION["edit_category_attr"]) and $_SESSION["edit_category_attr"] == "empty") {
                            ?>
                            <div class="alert alert-warning alert-dismissable text-center">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <a class="alert-link"> نام ویژگی نمیتواند خالی باشد !</a>
                            </div>
                        <?php }
                        unset($_SESSION["edit_category_attr"]);
                        ?>
                        <h4 style="margin: 10px 0 30px 0;float: left">
                            <a href="<?= SITE_URL ?>admin_ecomm_product_category/attr/<?= $attrs["category_id"] ?>">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a>
                        </h4>
                        <form action="<?= SITE_URL ?>admin_ecomm_product_category/update_attr/<?= $attrs["id"] ?>/<?= $attrs["parent"] ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="m-t-20">
                                <h5><b>نام دسته</b></h5>
                                <input required type="text" name="name" class="form-control"
                                       id="thresholdconfig" value="<?= $attrs["title"] ?>"/>
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

