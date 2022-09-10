<?php
$site_about = $data["site_about"];
$team_gallery = $data["team_gallery"];

?>


<div class="step-breadcump">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="breadcump-text">
                    <ul>
                        <li><a>صفحه اصلی<span>/</span> </a></li>
                        <li class="active"><a> درباره ما</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- end breadcump -->
<div class="step-get-in-touch section-pading">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">

                <a><h2 class="main-section-heading text-center" style="color: #333333">
                        <?php print_r($site_about["title"]) ?></h2></a>

                <div style="text-align: center">
                    <img src="<?= SITE_URL ?>public/posts/<?= $site_about["id"] ?>/<?= $site_about["img_name"] ?>"
                         alt="" class="about_us_img  img-thumbnail">
                </div>
                <h4 style="text-align: justify;line-height: 30px">
                    <?php print_r($site_about["contect"]) ?>
                </h4>


            </div>
        </div> <!-- end row -->

        <style>
            @media (min-width: 640px) {

                .clerk_img_box {
                    margin-top: 15px;
                    width: 20% !important;
                    height: 220px;
                }

                .clerk_img_box img {
                    height: 220px;
                }
            }
        </style>

        <div class="row">
            <div class="col-xs-12">
                <div class="section-title text-center">
                    <h2 class="main-section-heading" style="margin-top:100px; "><span
                                class="sec-bar"> با ما آشنا شوید </span>
                    </h2>
                    <div class="middle-con  " style="margin: 10px 0 30px">
                        <p> تیم تخصصی آی ام تی ، با سالها تجربه ی برنامه نویسی در زمینه ی وب ، انیمیشن ، ربات نویسی ،
                            طراحی
                            لوگو و اپلکیشن ، توانایی آماده سازی انواع
                            سفارشات شما را دارد</p>
                    </div>
                </div>
            </div>
            <?php foreach ($team_gallery as $team) { ?>
                <div class="col-md-3 col-sm-12 clerk_img_box">
                    <div class="single-team waves-effect waves-teal">
                        <img src="<?= SITE_URL ?>public/images/team/<?= $team["img_name"] ?>"
                             alt="<?= $team["user_name"] ?>">
                        <div class="hover-content-tem">
                            <div class="tem-hover-icon">
                            </div>
                            <div class="tem-text">
                                <h3><?= $team["user_name"] ?></h3>
                                <h4><?= $team["occupation"] ?></h4>
                            </div>
                        </div>
                    </div>
                </div><!--end person1-->
            <?php } ?>

        </div><!-- end row -->
    </div>
</div><!-- end main-contact -->
</div><!-- end   -->

<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
