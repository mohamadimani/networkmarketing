<?php
$blogs = $data["blog"];
?>
<div class="step-breadcump">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="breadcump-text">
                    <ul>
                        <li><a href="#">صفحه اصلی<span>/</span> </a></li>
                        <li class="active"><a href="#">مقالات</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- end breadcump -->
<div class="blog-main section-pading">
    <div class="container">
        <div class="row  mtb-100">
            <?php
            foreach ($blogs as $blog) {
                ?>
                <div class="col-md-6 col-sm-12 col-xs-12 " style="margin-bottom: 100px">
                    <div class="single-blog left-sidebar">
                        <a href="<?= SITE_URL ?>single/index/<?= $blog["id"] ?>">
                            <div class="blog-thumb">
                                <img src="<?= SITE_URL ?>public/posts/<?= $blog["id"] ?>/<?= $blog["img_name"] ?>"
                                     alt="ریز پردازنده فراهوش" style="width: 100%;height: 250px;">
                                <i class="fa fa-link"></i>
                                <div class="blog-time">
                                    <span><?= $blog["new_date"] ?></span>
                                </div>
                                <!-- end blog time -->
                            </div>
                            <!-- end blog thumb -->
                        </a>
                        <article class="step-article">
                            <a href="<?= SITE_URL ?>single/index/<?= $blog["id"] ?>">
                                <h2 class="blog-title"><?= $blog["title"] ?> </h2>
                            </a>
                            <p> <?= $blog["contect"] ?></p>
                            <a href="<?= SITE_URL ?>single/index/<?= $blog["id"] ?>" class="link-1">بیشتر<i
                                        class="fa fa-angle-double-left"></i></a>
                        </article>
                    </div>
                </div>
                <?php
            } ?>
        </div><!-- end row -->
    </div>
</div><!-- end main-contact -->
</div><!-- end webideh -->
