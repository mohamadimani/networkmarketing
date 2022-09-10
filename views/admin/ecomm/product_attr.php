<?php
$product_attrs = $data["product_attrs"];
$product_info = $data["product_info"];
?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title"> ویژگی های محصول (<span
                                style="color:#ff3c15;"><?= $product_info["name"] ?></span>)</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card-box">
                        <h4 style="margin: 10px 0 30px 0;float: left;width: 100%;">
                            <a href="<?= SITE_URL ?>admin_ecomm_products">
                                    <span class="btn btn-success " style="float: left;">برگشت
                                        <i class="fa fa-undo"></i> </span></a>
                        </h4>
                        <?php if (empty($product_attrs)) { ?>
                            <h5 style="height: 100px;width: 100%; " class="text-danger"><b>
                                    هیچ ویژگی برای محصول <span><?= $product_info["name"] ?></span> یافت نشد!
                                </b></h5>
                            <?php
                        }
                        foreach ($product_attrs as $product_attr) {
                            if ($product_attr["parent"] == 0) { ?>
                                <h5 style="margin: 25px 0;padding: 0;width: 100%;"><b
                                            style="color: #ffa064;font-size: 18px"> <?= $product_attr["title"] ?> : </b>
                                </h5>
                            <?php } else { ?>
                                <div class="m-t-10">
                                    <h5><?= $product_attr["title"] ?></h5>
                                    <input required type="text" name="name" class="form-control"
                                           id="thresholdconfig" value="<?= $product_attr["value"] ?>"
                                           onblur="add_attr_value(<?= $product_info['id'] ?>,this,<?= $product_attr['attr_ids'] ?>)"/>
                                </div>
                            <?php }
                        } ?>

                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>
        function add_attr_value(product_id, item, attr_id) {
            var url = "<?= SITE_URL ?>admin_ecomm_products/add_attr_value";
            var value = $(item).val();
            var data = {"value": value, "product_id": product_id, "attr_id": attr_id};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal("با موفقیت ثبت شد", "", "success");
                } else {
                    swal("مشکل در ثبت !", "", "danger");
                }
            })
        }
    </script>