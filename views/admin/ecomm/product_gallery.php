<?php
$gallery = $data['product_images'];
$product_id = $data['product_id'];
//$get_gallery_category = $data['get_gallery_category'];

?>
<style>
    .box {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 1px 1px 5px #d3d3d3;
    }

    /*.up_btn {*/
    /*float: left !important;*/
    /*}*/

    .float_right {
        float: right !important;
    }

    .float_left {
        float: left !important;
    }

    .label2 {
        line-height: 50%;
        margin: 25px 10px;
    }

    .waves-effect {
        position: absolute;
    }
</style>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title"> گالری محصول </h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row port m-t-20 m-b-20">
                <div class="portfolioContainer ">
                    <div class="col-sm-12 col-xs-12  col-md-6 webdesign illustrator">
                        <form action="<?= SITE_URL ?>admin_ecomm_products/upload_gallery/<?= $product_id ?>"
                              method="post"
                              enctype="multipart/form-data">
                            <div class="gal-detail thumb float_right">
                                <label class="control-label label2 col-xs-12 float_right  col-md-3 "> آپلود عکس
                                    جدید</label>
                                <div class="form-group m-t-20 float_left  col-xs-12  col-md-8">
                                    <input type="file" name="product_img" class="filestyle up_img float_right m-l-20"
                                           data-size="sm">
                                    <input type="submit" class="btn float_left btn-success up_btn m-l-20" value="آپلود">
                                </div>
                            </div>
                        </form>
                        <h4 style="margin: 10px 0 30px 0;float: left;width: 100%;">
                            <a href="<?= SITE_URL ?>admin_ecomm_products">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a>
                        </h4>
                    </div>

                </div>
            </div>

            <div class="row port">
                <div class="portfolioContainer">
                    <?php
                    foreach ($gallery as $row) { ?>
                        <div class="col-sm-6 col-lg-3 m-t-20 col-md-4 webdesign illustrator">
                            <div class="gal-detail box " >
                                <button onclick="delete_img(<?= $row['id'] ?>,this)"
                                        class="btn btn-icon waves-effect waves-light btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <div style="width: 100%;text-align: center;float: right;">
                                    <img src="<?= SITE_URL ?>public/product/<?= $row['product_id'] ?>/gallery/s/<?= $row['img_name'] ?>"
                                         class="thumb-img" alt="<?= $row['seo'] ?>" style="width: auto;height: 150px;">
                                </div>

                                <div>
                                    <label class="col-sm-6 control-label" for="m2">سئو</label>
                                    <div class="">
                                        <input id="m2" onblur="set_alt(this,<?= $row['id'] ?>)" type="text"
                                               class="input-sm form-control" name="alt" value="<?= $row['seo'] ?>">
                                    </div>
                                </div>

                                <div class="radio radio-custom">
                                    <input id="ch1<?= $row['id'] ?>"
                                           type="radio" <?php if ($row['main'] == "ACTIVE") {
                                        echo "checked";
                                    } ?> onchange="set_main(this,<?= $row['id'] ?>)"
                                           name="main">
                                    <label for="ch1<?= $row['id'] ?>">تصویر اصلی محصول
                                    </label>
                                </div>

                                <div class="checkbox checkbox-custom">
                                    <input id="ch2<?= $row['id'] ?>"
                                           type="checkbox" <?php if ($row['status'] == "ACTIVE") {
                                        echo "checked";
                                    } ?> onchange="set_show(this,<?= $row['id'] ?>)"
                                           name="status">
                                    <label for="ch2<?= $row['id'] ?>">نمایش
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div> <!-- End row -->
        </div> <!-- content -->
    </div>

    <script>

        function set_main(item, id) {
            var item_name = $(item).attr("name");
            var url = "<?= SITE_URL ?>admin_ecomm_products/save_change";
            var data = {"name": item_name, "id": id, "status": "YES"};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("ثبت شد", " ", "success")
                } else {
                    swal("مشکل در سیستم ذخیره", " ", "danger")
                }
            })
        }

        function set_show(item, id) {
            var item_name = $(item).attr("name");
            var url = "<?= SITE_URL ?>admin_ecomm_products/save_change";
            if ($(item).prop('checked')) {
                var data = {"name": item_name, "id": id, "status": "YES"};
                $.post(url, data, function (msg) {
                    if (msg == true) {
                        swal("ثبت شد", " ", "success")
                    } else {
                        swal("مشکل در سیستم ذخیره", " ", "danger")
                    }
                })
            } else {
                var data = {"name": item_name, "id": id, "status": "NO"};
                $.post(url, data, function (msg) {
                    if (msg == true) {
                        swal("ثبت شد", " ", "success")
                    } else {
                        swal("مشکل در سیستم ذخیره", " ", "danger")
                    }
                })
            }
        }

        function set_alt(item, id) {
            var item_value = $(item).val();
            var url = "<?= SITE_URL ?>admin_ecomm_products/set_alt ";
            var data = {"value": item_value, "id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal(" ذخیره شد ", " ", "success");
                } else {
                    swal("مشکل در سیستم ذخیره", " ", "danger");
                }
            })
        }
        function delete_img(id, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_products/delete_img";
            var data = {"id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    $(item).parents(".box").remove();
                    swal(" حذف شد ", " ", "success");
                } else if (msg == 'main') {
                    swal("تصویر شاخص را نمیتوان حذف کرد!", " ", "warning");
                } else {
                    swal("مشکل در سیستم حذف", " ", "danger");
                }
            })
        }

    </script>