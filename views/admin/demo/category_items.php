<?php
$categorys = $data['demo_sub_category'];

?>


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title"> دسته های نمونه کارها</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card-box">
                        <?php foreach ($categorys as $category) { ?>
                            <div class="m-t-20">
                                <h5><b><?= $category["title"] ?></b></h5>
                                <a href="<?= SITE_URL ?>admin_demo/gallery/<?= $category["id"] ?>">
                                    <input type="button" class="form-control btn btn-success" value="ورود"/>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>
