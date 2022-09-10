<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title m-b-30">لیست محصولات</h4>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <?php
                            $categorys = $data["categorys"];
                            $products = $data["products"];
                            $all_category_child = $data["all_category_child"];

                            if (!empty($_SESSION["add_product"]) and $_SESSION["add_product"] == "success") {
                                ?>
                                <div class="alert alert-success alert-dismissable text-center">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        ×
                                    </button>
                                    <a class="alert-link"> محصول جدید با موفقیت ذخیره شد</a>
                                </div>
                            <?php }
                            unset($_SESSION["add_product"]);
                            ?>
                            <div class="row m-t-10 m-b-10">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="h5 m-0">
                                        <span class="vertical-middle"> نمایش بر اساس دسته اصلی : </span>
                                        <div class="btn-group vertical-middle" data-toggle="buttons">
                                            <select onchange="select_all_product(this)" name="s_all_p" id=""
                                                    class="form-control input-sm">
                                                <option value="0">همه دسته ها</option>
                                                <?php
                                                foreach ($categorys as $category) {
                                                    ?>
                                                    <option value="<?= $category["id"] ?>"><?= $category["title"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <span class="vertical-middle"> <b style="margin:0  10px">یا</b>  نمایش بر اساس زیر دسته ها :  </span>
                                        <div class="btn-group vertical-middle" data-toggle="buttons">
                                            <select onchange="select_cat_product(this)" name="s_cat_p" id=""
                                                    class="form-control input-sm">
                                                <option value="0">همه دسته ها</option>
                                                <?php foreach ($all_category_child as $all_category) {
                                                    ?>
                                                    <option value="<?= $all_category["id"] ?>"><?= $all_category["title"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-actions-bar">
                                    <thead>
                                    <tr>
                                        <th>محصول</th>
                                        <th>تاریخ ثبت</th>
                                        <th> گالری</th>
                                        <th>ویژگی</th>
                                        <th>وضعیت</th>
                                        <th>قیمت</th>
                                        <th style="min-width: 80px;">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody class="products">
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><img title="<?= $product["name"] ?>"
                                                     src="<?= SITE_URL ?>public/product/<?= $product["id"] ?>/gallery/s/<?= $product["image"] ?>"
                                                     class="thumb-sm" alt=""></td>
                                            <td><?= $product["date"] ?></td>
                                            <td>
                                                <a href="<?= SITE_URL ?>admin_ecomm_products/product_gallery/<?= $product["id"] ?>">
                                                    <i class="fa fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <a href="<?= SITE_URL ?>admin_ecomm_products/product_attr/<?= $product["id"] ?>"
                                                   class="text-dark">
                                                    <i class="fa fa-eye"></i></a>
                                            </td>
                                            <td class="act_title"><?php if ($product['status'] == 'ACTIVE') {
                                                    echo '<span style="color: #00c300"> فعال</span>';
                                                } elseif ($product['status'] == 'INACTIVE') {
                                                    echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                                } ?></td>
                                            <td><span> <?= $product["price"] ?> </span><span> تومان </span></td>
                                            <td><a style="cursor: pointer"
                                                   onclick="active_user(<?= $product['id'] ?>,'inactive',this)"
                                                   title="غیر فعال کردن"
                                                   class="table-action-btn <?php if ($product['status'] == 'INACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-warning btn-xs   fa fa-ban"></i></a>
                                                <a style="cursor: pointer"
                                                   onclick="active_user(<?= $product['id'] ?>,'active',this)"
                                                   title=" فعال کردن"
                                                   class="table-action-btn <?php if ($product['status'] == 'ACTIVE') {
                                                       echo 'hidden';
                                                   } ?>">
                                                    <i class="btn btn-success btn-xs md md-check "></i></a>
                                                <!-- ========== delete ====== -->
                                                <a href="<?= SITE_URL ?>admin_ecomm_products/edit_product/<?= $product['id'] ?>"
                                                   style="cursor: pointer" title="ویرایش" class="table-action-btn ">
                                                    <i class="btn btn-info btn-xs md md md-edit "></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> <!-- end col -->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>

    <script>

        function active_user(id, status, item) {
            var url = "<?= SITE_URL ?>admin_ecomm_products/product_status_change";
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

        function select_all_product(item) {
            var category_id = $(item).val();
            var url = "<?= SITE_URL ?>admin_ecomm_products/get_ajax_product_cat";
            var data = {"category_id": category_id};
            $("tbody.products").html("");
            $.post(url, data, function (msg) {
                $.each(msg, function (index, value) {
                    var btn = '';
                    var act_hide = '';
                    var inact_hide = '';
                    if (value['status'] == 'ACTIVE') {
                        btn = '<span style="color: #00c300"> فعال</span>';
                        act_hide = "hidden";
                    } else {
                        btn = '<span style="color: #ff0e0e">غیر فعال</span>';
                        inact_hide = "hidden";
                    }
                    console.log(value);
                    var product_row = '<tr><td><img title="' + value["name"] + '" src="<?= SITE_URL ?>public/product/' + value["id"] + '/gallery/s/' + value["image"] + '" class= "thumb-sm" alt = ""> </td > ';
                    product_row += '<td>' + value["date"] + '</td><td><a href="<?= SITE_URL ?>admin_ecomm_products/product_gallery/' + value["id"] + '"><i class="fa fa-eye"></i></a></td>';
                    product_row += '<td><a href="<?= SITE_URL ?>admin_ecomm_products/product_attr/' + value["id"] + '" class="text-dark"><i class="fa fa-eye"></i></a></td>';
                    product_row += '<td class="act_title">' + btn + '</td><td><span>' + value["price"] + '</span><span> تومان </span></td>';
                    product_row += ' <td><a style="cursor: pointer" onclick="active_user(' + value["id"] + ',\'inactive\',this)" title="غیر فعال کردن" class="table-action-btn ' + inact_hide + ' "><i class= "btn btn-warning btn-xs   fa fa-ban" ></i></a><a style="cursor: pointer" onclick = "active_user(' + value["id"] + ',\'active\',this)" title = " فعال کردن" class= "table-action-btn ' + act_hide + ' " > <i class= "btn btn-success btn-xs md md-check " > </i > </a > <a href = "<?= SITE_URL ?>admin_ecomm_products/edit_product/' + value["id"] + '" style = "cursor: pointer" title =  "ویرایش" class= "table-action-btn " > <i class= "btn btn-info btn-xs md md md-edit "></i></a></td > ';
                    product_row += '<tr>';

                    $("tbody.products").append(product_row);
                })
            },"json")
        }

        function select_cat_product(item) {
            var category_id = $(item).val();
            var url = "<?= SITE_URL ?>admin_ecomm_products/get_ajax_product_child";
            var data = {"category_id": category_id};
            $("tbody.products").html("");
            $.post(url, data, function (msg) {
                $.each(msg, function (index, value) {
                    var btn = '';
                    var act_hide = '';
                    var inact_hide = '';
                    if (value['status'] == 'ACTIVE') {
                        btn = '<span style="color: #00c300"> فعال</span>';
                        act_hide = "hidden";
                    } else {
                        btn = '<span style="color: #ff0e0e">غیر فعال</span>';
                        inact_hide = "hidden";
                    }
                    console.log(value);
                    var product_row = '<tr><td><img title="' + value["name"] + '" src="<?= SITE_URL ?>public/product/' + value["id"] + '/gallery/s/' + value["image"] + '" class= "thumb-sm" alt = ""> </td > ';
                    product_row += '<td>' + value["date"] + '</td><td><a href="<?= SITE_URL ?>admin_ecomm_products/product_gallery/' + value["id"] + '"><i class="fa fa-eye"></i></a></td>';
                    product_row += '<td><a href="<?= SITE_URL ?>admin_ecomm_products/product_attr/' + value["id"] + '" class="text-dark"><i class="fa fa-eye"></i></a></td>';
                    product_row += '<td class="act_title">' + btn + '</td><td><span>' + value["price"] + '</span><span> تومان </span></td>';
                    product_row += ' <td><a style="cursor: pointer" onclick="active_user(' + value["id"] + ',\'inactive\',this)" title="غیر فعال کردن" class="table-action-btn ' + inact_hide + ' "><i class= "btn btn-warning btn-xs   fa fa-ban" ></i></a><a style="cursor: pointer" onclick = "active_user(' + value["id"] + ',\'active\',this)" title = " فعال کردن" class= "table-action-btn ' + act_hide + ' " > <i class= "btn btn-success btn-xs md md-check " > </i > </a > <a href = "<?= SITE_URL ?>admin_ecomm_products/edit_product/' + value["id"] + '" style = "cursor: pointer" title =  "ویرایش" class= "table-action-btn " > <i class= "btn btn-info btn-xs md md md-edit "></i></a></td > ';
                    product_row += '<tr>';

                    $("tbody.products").append(product_row);
                })
            }, "json")
        }
    </script>