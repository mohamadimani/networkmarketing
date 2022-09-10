<?php
$contact = $data["contact"];
?>
<div class="vsc-lp-marquee-module marquee marquee-app-landing contact-us">
    <div class="container relative-position">
        <div class="row">
            <div class="marquee-www-rebrand-wrap-compressed ">

                <div class="col-sm-12">

                    <div class="row">
                        <div class="lp-marquee-content svg-underlay col-sm-6 col-lg-5 col-xs-12">
                            <div class="marquee-pro-left-text">
                                <div class="lp-product-feature-image">
                                </div>
                                <div class="marquee-product-name h4 headline-primary"><h1><span
                                                class="headline-primary h3">تماس با ما</span></h1></div>
                                <p>
                                    لطفاً جهت تسريع در امر پاسخگويي و برقراري ارتباط صحيح با بخش مورد نظر خود به موضوع
                                    ارتباط آن بخش توجه فرمائيد.
                                </p>

                                <p class="h3 webideh"> پاسخگویی به ایمیل ها به صورت شبانه روزی میباشد.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="step-breadcump">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="breadcump-text">
                    <ul>
                        <li><a href="#">صفحه اصلی<span>/</span> </a></li>
                        <li class="active"><a href="#">تماس با ما</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- end breadcump -->
<div class="step-get-in-touch section-pading">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!empty($_SESSION["send_message"]) and $_SESSION["send_message"] == "danger") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <h3><a class="alert-link">مشکل در ارسال پیام !</a></h3>
                    </div>
                <?php }
                if (!empty($_SESSION["send_message"]) and $_SESSION["send_message"] == "success") {
                    ?>
                    <div class="alert alert-success alert-dismissable text-center">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×
                        </button>
                        <h3><a class="alert-link">پیام شما با موفقیت ارسال شد </a></h3>
                    </div>
                <?php }
                unset($_SESSION["send_message"]);
                ?>
                <div class="section-title text-center">
                    <h2 class="main-section-heading" style="margin:60px 0;"><span class="sec-bar"> با ما در ارتباط  باشید </span>
                    </h2>
                </div>
            </div>
            <!-- end section title -->
        </div>
        <!-- end row -->
        <div class="row">
            <div class="contact-address">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="single-contact-address">
                        <div class="media">
                            <div class="pull-right">
                                <div class="con-i">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <p><a style="vertical-align: -20px"><?= $contact["address"] ?></a></p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end single contact address -->
                <div class="col-md-3 col-sm-4 col-xs-12 mbt-30">
                    <div class="single-contact-address">
                        <div class="media">
                            <div class="pull-right">
                                <div class="con-i">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <div class="media-body">
                                <p style="margin: 0!important;"><a
                                            style="vertical-align: -22px"><?= $contact["phone"] ?></a></p>
                                <p style="margin-right: 25px"><?= $contact["mobile"] ?></p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end single contact address -->
                <div class="col-md-3 col-sm-4 col-xs-12 mbt-30">
                    <div class="single-contact-address">
                        <div class="media">
                            <div class="pull-right">
                                <div class="con-i">
                                    <i class="md md-email fa "></i>
                                    <!--                                    <i class="fa fa-paper-plane"></i>-->
                                </div>
                            </div>
                            <div class="media-body">
                                <p><a style="vertical-align: -20px"><?= $contact["email"] ?></a></p>
                                <!--                                <p><a href="mailto:www.yourweb.com">www.yourweb.com</a></p>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end single contact address -->

                <div class="col-md-3 col-sm-4 col-xs-12 mbt-30">
                    <div class="single-contact-address">
                        <div class="media">
                            <div class="pull-right">
                                <div class="con-i">
                                    <i class="  fa fa-fax " style="font-size: 16px;line-height: 24px"></i>
                                    <!--                                    <i class="fa fa-paper-plane"></i>-->
                                </div>
                            </div>
                            <div class="media-body">
                                <p><a style="vertical-align: -20px"><?= $contact["phone"] ?></a></p>
                                <!--                                <p><a href="mailto:www.yourweb.com">www.yourweb.com</a></p>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end single contact address -->

            </div>
        </div> <!-- end row -->

        <style>
            .btn-info {
                color: #ffffff !important;
                background-color: #ccb47b !important;
                border: 2px solid #ccb47b !important;
                box-shadow: 1px 1px 2px #595a5a !important;
            }

            .btn-info:hover {
                color: #ffffff!important;
                background-color: #d7be82!important;
                border: 2px solid #d7be82!important;
                box-shadow: 2px 2px 4px #595a5a!important;
            }
            .btn-info:active {
                color: #ffffff !important;
                background-color: #ccb47b !important;
                border: 2px solid #ccb47b !important;
                box-shadow: 1px 1px 2px #595a5a !important;
            }
        </style>

        <div class="big-spacer2"></div> <!-- end big spacer -->
        <div class="row">
            <form action="<?= SITE_URL ?>contact/save_conmment" class="main-contact-form-contact" method="post">
                <div class="col-md-6">
                    <input required placeholder="نام و نام خانوادگی" type="text" name="name">
                    <input required placeholder="ایمیل" type="email" name="email">
                    <input required placeholder="موبایل" type="tel" name="phone">
                    <div class="text-right">

                        <button class="  btn btn-info ">
                            ارسال
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <textarea required placeholder="متن پیام" name="comment"></textarea>
                </div>
            </form>
        </div>
    </div>
</div><!-- end main-contact -->
</div><!-- end webideh -->
