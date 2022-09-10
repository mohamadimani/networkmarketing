<?php
$demo_gallery = $data['demo_gallery'];
$demo_category = $data['demo_category'];
$category_id = $data['category_id'];

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

    /*.m-l-20 {*/
    /*margin: 0 0 0 10px;*/
    /*}*/

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
                    <h4 class="page-title">گالری نمونه کارها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>
            <div class="row port m-t-20 m-b-20">
                <div class="portfolioContainer ">
                    <div class="col-sm-12 col-xs-12  col-md-8 webdesign illustrator">
                        <form action="<?= SITE_URL ?>admin_demo/upload_demo/<?= $category_id ?>" method="post"
                              enctype="multipart/form-data">
                            <div class="gal-detail thumb float_right">
                                <label class="control-labe2 label2 col-xs-12 float_right  col-md-3 "> آپلود فایل صوتی
                                    جدید</label>
                                <div class="form-group m-t-20 float_left  col-xs-12  col-md-8">
                                    <input type="file" name="demo_img" class="filestyle up_img float_right m-l-20"
                                           data-size="sm">
                                    <input type="submit" class="btn float_left btn-success up_btn m-l-20" value="آپلود">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <a href="<?= SITE_URL ?>admin_demo" class="btn btn-info">بازگشت</a>
            </div>
            <div class="row port">
                <div class="portfolioContainer">
                    <?php
                    foreach ($demo_gallery as $row) { ?>
                        <div class="col-sm-6 col-lg-4 m-t-20 col-md-4 webdesign illustrator">
                            <div class="gal-detail box ">
                                <button onclick="delete_img(<?= $row['id'] ?>,this)"
                                        class="btn btn-icon waves-effect waves-light btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                                <img src="<?= SITE_URL ?>public/images/demo/<?= $row["img_name"] ?>" alt=""
                                     style="width: 100%!important;height: 200px!important;">
                                <div>
                                    <label class="col-sm-8 control-label" for="m1">دسته بندی</label>
                                    <div class="">
                                        <select onchange="set_category(this,<?= $row["id"] ?>)" name="category" id="m1"
                                                required class="input-sm form-control">
                                            <option value="0">انتخاب کنید</option>
                                            <?php
                                            foreach ($demo_category as $category) {
                                                if ($row['category'] == $category['id']) {
                                                    $select = "selected";
                                                } else {
                                                    $select = "";
                                                }
                                                ?>
                                                <option <?= $select ?>
                                                        value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="col-sm-6 control-label" for="m1">لینک</label>
                                    <div class="">
                                        <input id="m1" onblur="set_link(this,<?= $row['id'] ?>)" type="text"
                                               class="input-sm form-control" name="link" value="<?= $row['link'] ?>">
                                    </div>
                                </div>

                                <div>
                                    <label class="col-sm-6 control-label" for="m2">عنوان</label>
                                    <div class="">
                                        <input id="m2" onblur="set_alt(this,<?= $row['id'] ?>)" type="text"
                                               class="input-sm form-control" name="alt" value="<?= $row['title'] ?>">
                                    </div>
                                </div>

                                <div class="checkbox checkbox-custom">
                                    <input id="ch2<?= $row['id'] ?>"
                                           type="checkbox" <?php if ($row['status'] == "ACTIVE") {
                                        echo "checked";
                                    } ?> onchange="set_check(this,<?= $row['id'] ?>)" name="demo_show">
                                    <label for="ch2<?= $row['id'] ?>">نمایش</label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div> <!-- End row -->
        </div> <!-- content -->
    </div>

    <script>

        function set_category(item, img_id) {
            var cat_id = $(item).val();
            var url = "<?= SITE_URL ?>admin_demo/update_demo_category";
            var data = {"cat_id": cat_id, "img_id": img_id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("دسته جدید ثبت شد", " ", "success");
                } else {
                    swal("مشکل در سیستم ثبت !", " ", "danger");
                }
            })
        }

        function set_check(item, id) {
            var item_name = $(item).attr("name");
            var url = "<?= SITE_URL ?>admin_demo/save_change";
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

        function set_link(item, id) {
            var item_value = $(item).val();
            var url = "<?= SITE_URL ?>admin_demo/set_link";
            var data = {"value": item_value, "id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("لینک ذخیره شد ", " ", "success");
                } else {
                    swal("مشکل در سیستم ذخیره", " ", "danger");
                }

            })
        }

        function set_alt(item, id) {
            var item_value = $(item).val();
            var url = "<?= SITE_URL ?>admin_demo/set_alt";
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
            var url = "<?= SITE_URL ?>admin_demo/delete_img";
            var data = {"id": id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    $(item).parents(".box").remove();
                    swal(" حذف شد ", " ", "success");
                } else {
                    swal("مشکل در سیستم حذف", " ", "danger");
                }
            })
        }
    </script>