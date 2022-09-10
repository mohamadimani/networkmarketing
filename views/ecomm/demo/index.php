<?php
$demo_sub_category = $data["demo_sub_category"];
$projects = $data["projects"];


?>
<link rel="stylesheet" href="<?= SITE_URL ?>public/web/css/demostyle.css">
<link rel="stylesheet" href="<?= SITE_URL ?>public/web/css/font.css">

<!-------------------------------web site ----------------------------------------->

<style>
    .exhead {
        font-family: "BINK-font" !important;
    }

    .hover_img, .title-of-site, .type-of-product {
        font-family: "BINK-font" !important;
    }

    .openpage .readme1 {
        background-color: #d7be81;
        border-radius: 10px;
        border: 1px solid #3c3c3c;
        padding: 10px 15px;
        margin-top: -40px;
        color: white;
        text-align: center;
        font-weight: bold;
        float: left;
        box-shadow: 1px 1px 2px #505050;
    }

    .macintosh {
        height: auto !important;
    }

    .go-to-site {
        /*height: 100% !important;*/
    }

    .text_progress {
        font-size: 14px !important;
        color: #3c3c3c;
        font-weight: bold !important;
        font-family: "BINK-font", sans-serif !important;
    }

    .progress_label {
        font-weight: bold;
        font-size: 17px;
        direction: rtl !important;
        font-family: "BINK-font", sans-serif !important;
    }
</style>


<section class="container-fluid">
    <section class="row">
        <section class="container">
            <div class="samplework rtl">
                <h3 class="exhead"> پروژه های درحال انجام </h3>
            </div>
            <section class="row demo_item" style="min-height: 1px!important;">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">

                                <div class="col-sm-11 col-sm-offset-1">
                                    <?php foreach ($projects as $key => $project) { ?>
                                        <label for="" class="progress_label">
                                            <span class="text_progress"> پروژه  </span>:
                                            <span class="text_progress"> <?= $project["title"] ?> </span>
                                        </label>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success progress-bar-striped progress-animated wow animated"
                                                 role="progressbar" aria-valuenow="<?= $project["progress"] ?>"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width: <?= $project["progress"] ?>%;">
                                                <span class="text_progress"><?= $project["progress"] ?>% انجام شده</span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End of Row -->


            </section>
        </section>
    </section>
</section>

<?php foreach ($demo_sub_category as $category) { ?>

    <section class="container-fluid">
        <section class="row">
            <section class="container">
                <div class="samplework rtl">
                    <h3 class="exhead"> نمونه کارهای <?= $category["title"] ?> </h3>
                    <div class="openpage">
                        <a onclick="add_demo_itrm(this,<?= $category["id"] ?>)">
                            <button class="readme1 btn btn-xs "><i class="fa fa-plus"></i></button>
                        </a>
                    </div>
                </div>
                <section class="row demo_item" style="min-height: 1px!important;">


                </section>
            </section>
        </section>
    </section>
<?php } ?>


<script>

    function add_demo_itrm(item, category_id) {
        var url = "<?= SITE_URL ?>web_demo/get_all_demo";
        var data = {"category_id": category_id};
        var item_old_class = $(item).find("i").attr("class");
        $(item).find("i").removeClass();
        $(item).find("i").addClass("fa fa-minus");
        $(item).parents("section.container").find("section.demo_item").html(" ");
        $.post(url, data, function (msg) {
            var demo = "";
            var value2;
            $.each(msg, function (index, value) {
                value2 = value;
                demo = demo + '<a   href="' + value["link"] + '" target="_blank" class="hover_img" ><div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 hover_img"><div class="macintosh">\n' +
                    '<img onmouseover="mouser_inter1(this)" onmouseleave="mouser_leave1(this)"  class="display" src="\n' +
                    '<?= SITE_URL ?>public/web/accets/image/pc.png"> <a class="go-to-site">\n' +
                    '<div class="inmac"> <img class="iii" src="<?= SITE_URL ?>public/images/demo/' + value["img_name"] + '"> </div> </a> </div>\n' +
                    '<h4 class="title-of-site" STYLE="margin-bottom:20px!important;"> ' + value["title"] + ' </h4>  <h6 class="type-of-product">  ' + value["cet_title"] + ' </h6> </div> </a> \n';
            });
            var more_item = '<a href="<?= SITE_URL ?>web_demo/all_demo/' + value2["cat_group"] + '" class="btn btn-info"\n' +
                'style="background: #242424;border-color: #242424">مشاهده همه</a>';
            demo += more_item;
            console.log(demo);
            $(item).parents("section.container").find("section.demo_item").append(demo);
            // $(item).find("i").removeClass();
            // $(item).find("i").addClass(item_old_class);
        }, 'json');

    }

    function mouser_inter1(item) {
        var scroltime;
        var img_height = $(item).parents("div.hover_img").find(" img.iii").css("height");
        img_height = parseInt(img_height);
        if (img_height < 150) {
            img_height = img_height - img_height;
        } else {
            img_height = img_height - 150;
        }
        if (img_height < 350) {
            scroltime = 1000;
        } else {
            scroltime = 4000;
        }
        $(item).parents("div.hover_img").find(" img.iii").animate({"top": -img_height}, scroltime);
    }

    function mouser_leave1(item) {
        var img_height = $(item).parents("div.hover_img").find(" img.iii").css("height");
        img_height = parseInt(img_height) - 150;
        $(item).parents("div.hover_img").find(" img.iii").stop().animate({"top": 0}, 100);
    }

    setInterval(function () {
        change_color();
    }, 1600);

    function change_color() {
        $("button.readme1 ").css({"background-color": "#d7be81"});
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#e0b655"});
        }, 200);
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#d18a46"});
        }, 400);
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#d74b3f"});
        }, 600);
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#d18a46"});
        }, 800);
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#e0b655"});
        }, 1200);
        setTimeout(function () {
            $("button.readme1 ").css({"background-color": "#d7be81"});
        }, 1400);

    }


</script>

