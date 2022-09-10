<?php
/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 11:17 PM
 */
$last_page = "";
if (isset($_SERVER['HTTP_REFERER'])) {
    $last_page = $_SERVER['HTTP_REFERER'];
} else if (!empty($_SESSION['last_page'])) {
    $last_page = SITE_URL . $_SESSION['last_page'];
}

?>

<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Error 503 page">
    <meta name="keywords" content="Error_503">
    <title>Error 404 page</title>
</head>
<body>


<style>
    div.banner span {
        font-size: 15px;
        color: #ffffff;
        font-weight: bold;
        position: absolute;
        font-family: tahoma;
        bottom: 80px;
        left: 100px;
        border: 1px solid silver;
        padding: 10px 20px 13px;
        background-color: #40bca8;
        box-shadow: 1px 1px 2px silver;
        border-radius: 5px;
        z-index: 99999;
        cursor: pointer;
    }

    div.banner {
        width: 100%;
        float: left;
        text-align: center;
    }

    div.banner > img {
        padding: 5% 10%;
        margin: 0;
        position: relative;
        right: 0;
        top: 0;
        box-sizing: border-box;
    }

    footer {
        color: white !important;
    }
</style>

<div class="row banner" style="width: 100%;height: 100%; text-align: center;padding: 0;margin: 0;">
    <a href="<?= $last_page ?>"><span> بازگشت به صفحه قبل</span></a>
    <img src="<?= SITE_URL ?>public/images/errors/503.png" alt="imtit">
</div>


</body>
</html>
