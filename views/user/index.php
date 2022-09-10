<?php
/**
 * Created by PhpStorm.
 * User: Novin Pendar
 * Date: 03/14/2019
 * Time: 06:56 AM
 */
$user_info = $data["user_info"];

?>

<style>
    input {
        padding-right: 5px;
    }

    .alert button {
        width: 15px;
        height: 15px;
        float: left;
        background-color: inherit;
        font-size: 15px;
    }

    .alert {
        width: 100%;
        text-align: center;
        line-height: 50px;
        border-radius: 5px;
        height: 55px;
        font-size: 18px;
        font-weight: bold;
        margin: 10px auto 50px;

    }

    .alert-danger {
        background-color: rgba(255, 74, 82, 0.19);
        color: #ff2432;
    }

    .alert-success {
        background-color: rgba(0, 192, 0, 0.19);
        color: #00c000;
    }
</style>

<div class="dashboard-content">
    <!-- HEADLINE -->

    <?php
    if (!empty($_SESSION["user_update"]) and $_SESSION["user_update"] == "success") {
        ?>
        <div class="alert alert-success alert-dismissable text-center">
            <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                ×
            </button>
            <a class="alert-link">اطلاعات بروزرسانی شد</a>
        </div>
    <?php }
    if (!empty($_SESSION["user_update"]) and $_SESSION["user_update"] == "danger") {
        ?>
        <div class="alert alert-danger alert-dismissable text-center">
            <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                ×
            </button>
            <a class="alert-link"> مشکل در ثبت اطلاعات !</a>
        </div>
    <?php }
    if (!empty($_SESSION["user_update"]) and $_SESSION["user_update"] == "empty") {
        ?>
        <div class="alert alert-danger alert-dismissable text-center">
            <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                ×
            </button>
            <a class="alert-link">مقادیر نمیتوانند خالی باشند</a>
        </div>
    <?php }
    if (!empty($_SESSION["user_info"])) {
        ?>
        <div class="alert alert-danger alert-dismissable text-center">
            <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                ×
            </button>
            <a class="alert-link"><?= $_SESSION["user_info"] ?></a>
        </div>
    <?php }
    unset($_SESSION["user_update"]);
    unset($_SESSION["user_info"]);
    ?>
    <script>
        function close_alert(item) {
            $(item).parents("div.alert").fadeOut();
        }
    </script>
    <div class="headline buttons primary">
        <h4>تنظیمات حساب کاربری</h4>
    </div>
    <div class="form-box-items">
        <!-- FORM BOX ITEM -->
        <form id="profile-info-form" action="<?= SITE_URL ?>users/update_user_info" method="post"
              enctype="multipart/form-data">
            <div class="form-box-item">
                <h4>اطلاعات پروفایل</h4>
                <hr class="line-separator">
                <!--                <div class="profile-image">-->
                <!--                    <div class="profile-image-data">-->
                <!--                        <figure class="user-avatar medium">-->
                <!--                            <img src="-->
                <? //= SITE_URL ?><!--public\users\dashboard/dashboard-images/dashboard/profile-default-image.png"-->
                <!--                                 alt="profile-default-image">-->
                <!--                        </figure>-->
                <!--                        <p class="text-header">تصویر پروفایل</p>-->
                <!--                        <p class="upload-details">70x 70px</p>-->
                <!--                    </div>-->
                <!--                    <label for="user_img" class="button mid-short dark-light">آپلود تصویر</label>-->
                <!--                    <input type="file" name="user_img" style="display: none" id="user_img">-->
                <!--                </div>-->

                <div class="input-container">
                    <label for="acc_name" class="rl-label required">نام حساب کاربری</label>
                    <input type="text" id="acc_name" name="user_name" value="<?= $user_info["username"] ?>" disabled>
                </div>

                <div class="input-container">
                    <label for="new_email" class="rl-label">موبایل</label>
                    <input type="email" id="new_email" name="mobile" value="<?= $user_info["mobile"] ?>" disabled>
                </div>
                <!-- /INPUT CONTAINER -->

                <div class="input-container">
                    <label for="new_email" class="rl-label">ایمیل</label>
                    <input required type="email" id="new_email" name="email" value="<?= $user_info["email"] ?>"
                           placeholder="ایمیل  خود را وارد کنید">
                </div>

            </div>

            <div class="form-box-item padded">
                <h4>اطلاعات کلی </h4>
                <hr class="line-separator">
                <!-- INPUT CONTAINER -->
                <div class="input-container half">
                    <label for="first_name3" class="rl-label required">نام</label>
                    <input required type="text" form="profile-info-form" id="first_name3" name="name"
                           placeholder="نام خود را وارد کنید" value="<?= $user_info["name"] ?>">
                </div>
                <!-- /INPUT CONTAINER -->

                <!-- INPUT CONTAINER -->
                <div class="input-container half">
                    <label for="last_name3" class="rl-label required">نام خانوادگی</label>
                    <input required type="text" form="profile-info-form" id="last_name3" name="family"
                           placeholder="نام خانوادگی خود را وارد کنید" value="<?= $user_info["family"] ?>">
                </div>

                <!-- INPUT CONTAINER -->
                <div class="input-container">
                    <label for="address3" class="rl-label required">آدرس کامل</label>
                    <textarea required style="resize: none" form="profile-info-form" id="notes3" name="address"
                              placeholder="آدرس خود را وارد کنید"><?= $user_info["address"] ?></textarea>
                </div>
            </div>
            <button form="profile-info-form" class="button mid-short primary">ذخیره تغییرات</button>
        </form>
    </div>
</div>
</div>



