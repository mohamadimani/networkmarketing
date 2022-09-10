<?php
$single = $data["single"];
?>
<div class="step-breadcump">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="breadcump-text">
                    <ul>
                        <li><a href="<?= SITE_URL ?>">صفحه اصلی<span>/</span> </a></li>
                        <li class="active"><a href="<?= SITE_URL ?>blog">مقالات</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- end breadcump -->
<div class="blog-main-single section-pading">
    <div class="container">
        <div class="row  mtb-30">
            <div class="col-xs-12">
                <div class="step-single-blog">

                    <a><h1 class="main-section-heading text-center post_title" style="color: #333333">
                            <?= $single["title"] ?></h1></a>
                    <div style="text-align: center">
                        <img src="<?= SITE_URL ?>public/posts/<?= $single["id"] ?>/<?= $single["img_name"] ?>"
                             alt="ریز پردازنده فراهوش" class="about_us_img  img-thumbnail">
                    </div>
                    <!-- end post image -->
                    <h4 style="text-align: justify;line-height: 30px" class="post_text">
                        <?php print_r($single["contect"]) ?>
                    </h4>
                </div>

                <div class="eny_profile heading_space " style="padding: 0!important;">
                </div>
                <div class="eny_profile heading_space" style="padding: 0!important;">
                    <div class="profile_text">
                        <p class="darkcolor" style="float: right;margin-left: 20px;"><span>تاریخ انتشار :</span>
                            <span><?= $single["creat_date"] ?></span></p>
                        <p class="darkcolor"><span>تعداد بازدید  :</span> <span></span><?= $single["view_count"] ?>
                            <span style="margin:0 100px;">
                                <span>اشتراک گذاری در   : </span>
                                <a onclick="share_post(this)" style="margin: 0 10px  ;" target="_blank"
                                   class="fa fa-paper-plane"></a>
                            </span>
                        </p>
                    </div>
                </div>

            </div>
        </div><!-- end row -->
    </div>
</div><!-- end main-contact -->
</div><!-- end webideh -->

<script>
    seen_post(<?= $single["id"] ?>);
    function seen_post(post_id) {
        var url = "<?= SITE_URL ?>single/seen_post";
        var data = {'post_id': post_id};
        $.post(url, data, function (msg) {
        })
    }
    function share_post() {
        var post_title = $("h1.post_title").text();
        var post = $("h4.post_text").text();
        window.open('https://telegram.me/share/url?text=' + post_title + '&url=' + window.location.href)
    }

</script>
<!--href="https://telegram.me/share/url?url=--><? //= SITE_URL ?><!--single/index/--><? //= $single["id"] ?><!--&text=--><? //= $single["title"] ?><!--"-->
