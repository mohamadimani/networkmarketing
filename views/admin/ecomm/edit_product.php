<?php
$all_category = $data["categorys"];
$child_category = $data["child_category"];
$product = $data["product"];
?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="page-title">افزودن محصول</h1>
                    <div style="margin: 20px 0;"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <form method="post"
                          action="<?= SITE_URL ?>admin_ecomm_products/update_product/<?= $product["id"] ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-box">
                                    <?php
                                    if (!empty($_SESSION["add_product"]) and $_SESSION["add_product"] == "success") {
                                        ?>
                                        <div class="alert alert-success alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link"> محصول جدید با موفقیت ذخیره شد</a>
                                        </div>
                                    <?php }
                                    if (!empty($_SESSION["add_product"]) and $_SESSION["add_product"] == "price") {
                                        ?>
                                        <div class="alert alert-warning alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link"> قیمت محصول را درست وارد کنید</a>
                                        </div>
                                    <?php }
                                    if (!empty($_SESSION["add_product"]) and $_SESSION["add_product"] == "danger") {
                                        ?>
                                        <div class="alert alert-danger alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link">مشکل در ذخیره اطلاعات !</a>
                                        </div>
                                    <?php }
                                    if (!empty($_SESSION["add_product"]) and $_SESSION["add_product"] == "empty") {
                                        ?>
                                        <div class="alert alert-warning alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link"> لطفا اطلاعات رو کامل پر کنید !</a>
                                        </div>
                                    <?php }
                                    unset($_SESSION["add_product"]);
                                    ?>

                                    <div class="form-group m-b-20">
                                        <label>نام محصول <span class="text-danger">*</span></label>
                                        <input required type="text" name="title" class="form-control"
                                               placeholder="نام محصول" value="<?= @$product["name"] ?>">
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>دسته بندی ها <span class="text-danger">*</span></label>
                                        <select required class="form-control select2" name="category2"
                                                onchange="set_category_child(this)">
                                            <option>انتخاب دسته اصلی</option>
                                            <?php
                                            foreach ($all_category as $categorys) {
                                                $select = "";
                                                if ($categorys["id"] == $product["cat_gro"]) {
                                                    $select = "selected";
                                                }
                                                ?>
                                                <option <?= $select ?> value="<?= $categorys["id"] ?>">
                                                    <?= $categorys["title"] ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                        <br>
                                        <select required class="form-control select2" name="category">
                                            <option>انتخاب زیر دسته</option>
                                            <?php
                                            foreach ($child_category as $categorys) {
                                                $select = "";
                                                if ($categorys["id"] == $product["category"]) {
                                                    $select = "selected";
                                                } ?>
                                                <option <?= $select ?> value="<?= $categorys["id"] ?>">
                                                    <?= $categorys["title"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>توضیحات محصول <span class="text-danger">*</span></label>
                                        <textarea required class="editor1" name="introduction" id="editor1" cols="30"
                                                  rows="10"
                                                  placeholder="محتوای مطلب" data-toggle="tooltip" data-placement="top">
                                        <?= @$product["introduction"] ?>
                                        </textarea>
                                        <script>
                                            CKEDITOR.replace('editor1', {});
                                        </script>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>خلاصه محصول</label>
                                        <textarea required class="form-control" rows="3" name="summary"
                                                  placeholder="خلاصه محصول را وارد کنید"><?= @$product["summary"] ?></textarea>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>قیمت <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" name="price"
                                               value="<?= @$product["price"] ?>">
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label>سئو</label>
                                        <input required type="text" name="seo" class="form-control"
                                               placeholder="کلمات کلیدی" value="<?= @$product["seo"] ?>">
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label class="m-b-15">وضعیت <span class="text-danger">*</span></label>
                                        <br/>
                                        <div class="radio radio-inline">
                                            <input required type="radio" id="inlineRadio1" value="active" name="status"
                                            >
                                            <label for="inlineRadio1"> فعال </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input required type="radio" id="inlineRadio2" value="inactive"
                                                   name="status" checked="">
                                            <label for="inlineRadio2"> غیرفعال </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <hr/>
                                <div class="text-center p-20">
                                    <button type="submit" class="btn w-sm btn-default waves-effect waves-light">ذخیره
                                    </button>
                                    <a href="<?= SITE_URL ?>admin_ecomm_products">
                                        <button type="button" class="btn w-sm btn-danger waves-effect waves-light">لغو
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div>

<script>

    function set_category_child(item) {
        var cat_group = $(item).val();
        var url = "<?= SITE_URL ?>admin_ecomm_products/get_category_child_ajax";
        var data = {"cat_group": cat_group};
        $("select[name=category]").html("");
        $.post(url, data, function (msg) {
            console.log(msg);
            $.each(msg, function (index, value) {
                var product_row = '<option  value="' + value["id"] + '">' + value["title"] + '</option>';
                $("select[name=category]").append(product_row);
            })
        }, "json")
    }

</script>

