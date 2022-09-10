<?php
$law = $data["law"];
$user_info = $data["user_info"];


?>

<style>
    div.posts1 p {
        text-align: justify !important;
        direction: rtl;
        margin-right: 12pt !important;
        color: #595756 !important;
    }

    @media print {
        .main-menu-wrap, .post-image, .header-wrap, .cart-actions, footer {
            display: none !important;
        }
    }

</style>


<!-- SECTION -->
<div class="section-wrap">
    <div class="section">
        <!-- CONTENT -->
        <div class="content left" style="width: 100%;">
            <!-- POST -->
            <article class="post blog-post">
                <!-- POST IMAGE -->
                <div class="post-image">
                    <figure class="product-preview-image large liquid">
                        <img src="<?= SITE_URL ?>public/posts/<?= $law["id"] . "/" . $law["img_name"] ?>" alt="">
                    </figure>
                </div>

                <div class="post-content with-title">
                    <p class="text-header big text-center"><?= $law["title"] ?></p>
                    <div class="posts1">
                        <p> بخش اول: شرايط عمومي قرارداد
                        </p>
                        <p> اين قرارداد در تاريخ <?= $law["new_date"] ?> بين آقاي مهندس دانیال رضائی مدیرعامل شرکت
                            فناوری
                            ریزپردازنده فراهوش به شماره ثبت 15436 از يك ســو كه در اين قرارداد فروشنده ناميده مي شود
                        </p>
                        <p>و آقای/خانم <?= $user_info["name"] . " " . $user_info["family"] ?> به
                            کدملی <?= $user_info["id_number"] ?>
                            که در
                            این قرارداد به
                            عنوان خریدار نامیده می شود،
                            منعقد می گردد .
                        </p>

                        <p>ماده 1: موضوع قرارداد</p>
                        <p>موضوع قرارداد عبارتست از طراحی و پیاده سازی وبسایت طبق خواسته مشتری با استفاده از استانداردها
                            ، فراروش ، روش ها و شرح خدمات مورد تائید دوطرف و پيوستهاي قرارداد.
                        </p>
                        <p> تبصره1: در طول مدت اجراي قرارداد و پس از تحويل سامانه و نرم افزار ، از تاریخ پایان قرارداد
                            به مدت 6 ماه خدمات پشتيباني به عهده فروشنده خواهد بود ، پس از اتمام این مدت، درصورت نیاز
                            خریدار نسبت به انعقاد قرارداد پشتیبانی با شرایط و توافقات بعدی اقدام خواهد گردید.
                        </p>
                        <p> ماده 2: مدت اجراي قرارداد
                        </p>
                        <p> مدت اجراي قرارداد از تاريخ <?= $law["new_date"] ?> تا ۴۸ ساعت کاری بعد از تاریخ
                            قرارداد .
                        </p>
                        <p> ماده 3: مبلغ قرارداد
                        </p>
                        <p> مبلغ قرارداد برابر <?= $law["price_number"] ?> تومان ( <?= $law["price_str"] ?>
                            ) است كه بر اساس شرايط تعيين شده در شرايط اختصاصي قرارداد در مقابل انجام خدمات موضوع قرارداد
                            توسط فروشنده ، مبالغ به شرح ماده مربوطه به فروشنده پرداخت مي گردد.
                        </p>
                        <p> ماده 4: نشاني طرفين
                        </p>
                        <p> نشاني خریدار :
                            <?= $user_info["address"] ?>
                        </p>
                        <p>تلفن ثابت :
                            <?= $user_info["phone"] ?>
                        </p>
                        <p>تلفن همراه :
                            <?= $user_info["mobile"] ?>
                        </p>
                        <p> نشاني فروشنده : www.imtit.ir آدرس دفتر: قزوین- چهارراه عمران- نبش کوچه سهیل- پلاک 4- واحد3-
                            شرکت فناوری ریزپردازنده فراهوش
                        </p>
                    </div>
                    <div class="posts1">
                        <p><?= $law["contect"] ?></p>
                    </div>

                    <div class="cart-actions">
                        <a href="<?= SITE_URL ?>ecomm/basket" class="button mid primary">بازگشت به صفحه پرداخت </a>
                        </br>
                        <a onclick="print()" class="button mid dark-light spaced"> پرینت قرارداد</a>
                    </div>

                </div>
                <!-- /POST CONTENT -->

                <hr class="line-separator">

                <!-- SHARE -->
                <!--                <div class="share-links-wrap">-->
                <!--                    <p class="text-header small">به اشتراک بگذارید :</p>-->
                <!-- SHARE LINKS -->
                <!--                    <ul class="share-links hoverable">-->
                <!--                        <li><a href="#" class="gplus"></a></li>-->
                <!--                    </ul>-->
                <!-- /SHARE LINKS -->
                <!--                </div>-->
                <!-- /SHARE -->
            </article>
            <!-- /POST -->


        </div>
        <!-- CONTENT -->

    </div>
</div>
<!-- /SECTION -->
