<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">تنظیمات</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="card-box">
                        <form action="<?= SITE_URL ?>admin_options/save_options" method="post"
                              enctype="multipart/form-data">

                            <?php
                            $site_options = $data['site_options'];

                            foreach ($site_options as $item) {
                                if ($item['EN_name'] == "site_logo") { ?>
                                    <div class="row port">
                                        <div class="portfolioContainer">
                                            <div class="col-sm-8 col-xs-8   col-md-6 webdesign illustrator">
                                                <div class="gal-detail thumb">
                                                    <img src="<?= SITE_URL ?>public/images/<?= $item["value"] ?>"
                                                         class="thumb-img"
                                                         alt="work-thumbnail">
                                                    <h4>لوگوی سایت</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-t-20">
                                        <label class="control-label">تغییر لوگو</label>
                                        <input type="file" name="site_logo" class="filestyle" data-size="sm">
                                    </div>

                                <?php } else if ($item['category'] == "color") { ?>
                                    <div class="m-t-20">
                                        <h5><b><?= $item['options'] ?></b></h5>
                                        <input type="color" name="<?= $item["EN_name"] ?>" class="form-control"
                                               value="<?= $item['value'] ?>"/>
                                    </div>
                                <?php } else if ($item['category'] != "color" and $item['EN_name'] != "site_logo") { ?>
                                    <div class="m-t-20">
                                        <h5><b><?= $item['options'] ?></b></h5>
                                        <input type="text" name="<?= $item["EN_name"] ?>" class="form-control"
                                               value="<?= $item['value'] ?>"/>
                                    </div>
                                <?php }
                            } ?>

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
