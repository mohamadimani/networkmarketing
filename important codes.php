<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 04/14/2019
 * Time: 08:36 AM
 */
?>


<!--  site info  -->
<?= $site_options["address"] ?>
<?= $site_options["email"] ?>
<?= $site_options["phone"] ?>
<?= $site_options["mobile"] ?>
<?= $site_options["site_name"] ?>
<!--  End site info -->

<!--  url for links  -->
<?= SITE_URL ?>public/web/assets/

<!--***************************************************************************-->


<!--  header  -->

<title><?= $site_options["site_name"] ?></title>
<meta name="keywords" content="<?= $site_options["keywords"] ?>">
<meta name="description" content="<?= $site_options["site_description"] ?>">


<!--  menu  -->
<?php foreach ($ecomm_menu as $menu) { ?>
    <li><a href="<?= SITE_URL . $menu["link"] ?>"><?= $menu["name"] ?></a></li>
<?php } ?>

<!--  End header  -->


<!--***************************************************************************-->


<!--  Footer  -->

<!--  social  -->
<?php foreach ($get_socials as $social) { ?>
    <li><a href="<?= $social["link"] ?>">
            <span class="<?= $social["icon"] ?>"></span></a></li>
<?php } ?>


<p>طراحی شده توسط شرکت<a href="http://www.imtit.com"> فناوری ریزپردازنده فراهوش</a></p>

<!--  End footer  -->


<!--***************************************************************************-->


<!--  index page  -->

<!--  SERVICES  -->
<h3><?= $services[0]["category_name"] ?></h3>
<?php foreach ($services as $service) { ?>
    <li>
        <!--  more post info  -->
        <a href="<?= SITE_URL ?>single/index/<?= $service["id"] ?>">
            <i class="fa fa-angle-left"></i><?= $service["title"] ?></a>
    </li>
<?php } ?>
<!--  End index page  -->


<!--  last posts  -->

<!--  title of last posts  -->
<?= $last_news[0]["category_name"] ?>
<?php foreach ($last_news as $last_new) { ?>
    <!--post image -->
    <img src="<?= SITE_URL ?>public\posts/<?= $last_new["id"] . "/" . $last_new["img_name"] ?>"
         style="height: 100%; width: 100%;"/>
    <!--more post link-->
    <a href="<?= SITE_URL ?>single/index/<?= $last_new["id"] ?>" class="more">

        <?= $last_new["title"] ?>
        <?= $last_new["content"] ?>

    </a>
<?php } ?>

<!--  End last posts  -->


<!--    slider -->
<?php foreach ($get_slider as $key => $slide) { ?>
    <li data-target="#myCarousel" data-slide-to="<?= $key ?>"
        class="<?php if ($key == 0) {
            echo 'active';
        } ?>"></li>
<?php } ?>


<?php foreach ($get_slider as $key => $slide) { ?>
    <div class="item <?php if ($slide['id'] == $get_slider[0]['id']) {
        echo 'active';
    } ?>">
        <img src="<?= SITE_URL ?>public/images/gallery/<?= $slide["img_name"] ?>" alt=""
             style="width:100%;">
    </div>
<?php } ?>


<!--    End slider -->

<!--***************************************************************************-->
