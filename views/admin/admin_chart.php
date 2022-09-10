<style>
    .widget-panel, .card-box {
        box-shadow: 1px 1px 1px silver !important;
        border:none!important;
    }

</style>

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title m-b-20"> داشبورد </h4>
                </div>
            </div>
            <?php
            $all_index_view = $data["all_index_view"];
            $index_view = $data["index_view"];
            $get_posts_category = $data["get_posts_category"];
            $active_posts_category = $data["active_posts_category"];
            $get_posts_count = $data["get_posts_count"];
            $active_posts_count = $data["active_posts_count"];
            $more_view_posts = $data["more_view_posts"];


            ?>
            <div class="row">

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="ion-eye text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $all_index_view["views_count"] ?></span></h2>
                        <div class="text-muted m-t-5"> بازدید کننده کل</div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="ion-eye text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $all_index_view["all_views_count"] ?></span></h2>
                        <div class="text-muted m-t-5"> بازدید کل</div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="ion-eye text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $index_view["today_views"] ?></span></h2>
                        <div class="text-muted m-t-5"> بازدید کننده امروز</div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="ion-eye text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $index_view["all_today_views"] ?></span></h2>
                        <div class="text-muted m-t-5"> بازدید امروز</div>
                    </div>
                </div>

                <!--                end views -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="icon-layers text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $get_posts_category ?></span></h2>
                        <div class="text-muted m-t-5"> تعداد مجموعه ها</div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="icon-layers text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $active_posts_category ?></span></h2>
                        <div class="text-muted m-t-5"> مجموعه های فعال</div>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="icon-layers text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $get_posts_count ?></span></h2>
                        <div class="text-muted m-t-5"> تعداد پست ها</div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="widget-panel widget-style-2 bg-white">
                        <i class="icon-layers text-white text-primary"></i>
                        <h2 class="m-0 text-dark counter font-600"><span
                                    data-plugin="counterup"><?= $active_posts_count ?></span></h2>
                        <div class="text-muted m-t-5"> پست های فعال</div>
                    </div>
                </div>

                <!--                end posts and category -->


                <!-- Transactions -->
                <div class="col-lg-6 col-sm-12 ">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-20 header-title"><b>پربازدید ترین پست ها</b></h4>

                        <div class="nicescroll mx-box" style=" max-height: 180px;min-height: 180px;">
                            <ul class="list-unstyled transaction-list m-r-5">
                                <?php
                                foreach ($more_view_posts as $posts) {
                                    ?>
                                    <li>
                                        <i class="ti-upload text-success"></i>
                                        <a href="<?= SITE_URL ?>single/index/<?= $posts["id"] ?>"><span
                                                    class="tran-text"><?= $posts["title"] ?></span></a>
                                        <span class="   "><?= $posts["category"] ?></span>
                                        <span class="pull-right text-success tran-price"
                                              style="margin-left: 10px"><?= $posts["view_count"] ?></span>
                                        <span class="clearfix"></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                </div> <!-- end col -->
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div>