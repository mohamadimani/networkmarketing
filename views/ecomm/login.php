<style>
    .form-popup {
        direction: rtl;
        float: left !important;

    }

    @media (min-width: 540px) {
        .login {
            margin: 0 43px 0 130px;
        }

        .register {
            margin: 0 43px 0 0;
        }
    }

    @media (max-width: 530px) {
        .login, .register {
            margin: 20px 0 20px 16px !important;
        }
    }

    button {
        margin: 0 !important;
    }

    input[type="password"] {
        text-align: right;
        width: 100%;
        height: 40px;
        padding: 0 15px;
        border: 1px solid #ebebeb;
        line-height: 40px;
        border-radius: 4px;
        margin: 1px 0 20px 0;
    }

    input[type=tel] {
        text-align: right;
        width: 100%;
        height: 40px;
        padding: 0 15px;
        border: 1px solid #ebebeb;
        line-height: 40px;
        border-radius: 4px;
        margin: 1px 0 20px 0;
    }
</style>

<div class="section-wrap">
    <div class="section demo">
        <div class="form-popup login">
            <div class="form-popup-headline secondary" STYLE="padding: 10px 15px 15px  ">
                <h2> ورود</h2>
                <?php
                if (!empty($_SESSION["user_login"]) and $_SESSION["user_login"] == "password") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link"> رمز عبور صحیح نیست !</a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_login"]) and $_SESSION["user_login"] == "username") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link">نام کاربری پیدا نشد ! </a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_login"]) and $_SESSION["user_login"] == "empty") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link">مقادیر را کامل پر کنید !</a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_login"]) and $_SESSION["user_login"] == "inactive") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link"> حساب کاربری شما غیر فعال میباشد !</a>
                    </div>
                <?php }
                unset($_SESSION["user_login"]);
                ?>
            </div>
            <div class="form-popup-content">
                <form id="login-form2" method="post" action="<?= SITE_URL ?>users/check_user_login">
                    <label for="username5" class="rl-label">نام کاربری</label>
                    <input required type="text" id="username5" name="username"
                           placeholder="نام کاربری خود را وارد کنید...">
                    <label for="password5" class="rl-label">گذرواژه</label>
                    <input required type="password" id="password5" name="password">
                    <!-- <input type="checkbox" id="remember2" name="remember2" checked="">-->
                    <!-- <label for="remember2" class="label-check">-->
                    <!-- <span class="checkbox primary primary"><span></span></span>-->
                    <!-- مرا به خاطر بسپار-->
                    <!-- </label> -->
                    <!-- <p> رمزتان را گم کرده&zwnj;اید؟ <a href="#" class="primary">اینجا کلیک کنید!</a></p> -->
                    <button class="button mid dark">ورود</button>
                </form>
            </div>
        </div>
        <div class="form-popup register" style="">

            <div class="form-popup-headline primary" STYLE="padding: 10px 15px 15px  ">
                <h2>ثبت نام</h2>
                <?php
                if (!empty($_SESSION["user_register"]) and $_SESSION["user_register"] == "password") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link"> رمز عبور و تکرار رمز عبور صحیح نیست !</a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_register"]) and $_SESSION["user_register"] == "is_mobile") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link">  شماره موبایل تکراری است ! </a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_register"]) and $_SESSION["user_register"] == "is_username") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link">نام کاربری تکراری است ! </a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_register"]) and $_SESSION["user_register"] == "empty") {
                    ?>
                    <div class="alert alert-danger alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link">مقادیر را صحیح و کامل پر کنید !</a>
                    </div>
                <?php }
                if (!empty($_SESSION["user_register"]) and $_SESSION["user_register"] == "success") {
                    ?>
                    <div class="alert alert-success alert-dismissable text-center">
                        <button onclick="close_alert(this)" type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">
                            ×
                        </button>
                        <a class="alert-link"> ثبت نام انجام شد. وارد شوید </a>
                    </div>
                <?php }
                unset($_SESSION["user_register"]);
                ?>
            </div>

            <div class="form-popup-content">
                <form id="register-form4" method="post" action="<?= SITE_URL ?>users/user_register">
                    <label for="email_address6" class="rl-label required">شماره موبایل</label>
                    <input required type="tel" id="email_address6" name="mobile"
                           placeholder="موبایل خود را وارد کنید...">
                    <label for="username6" class="rl-label">نام کاربری</label>
                    <input required type="text" id="username6" name="username"
                           placeholder="نام کاربری خود را وارد کنید...">
                    <label for="password6" class="rl-label required">گذرواژه</label>
                    <input required type="password" id="password6" name="password"
                           placeholder="گذرواژه خود را وارد کنید...">
                    <label for="repeat_password6" class="rl-label required">تکرار گذرواژه</label>
                    <input required type="password" id="repeat_password6" name="re_password"
                           placeholder="تکرار گذرواژه...">
                    <button class="button mid dark">ثبت نام</button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
    function close_alert(item) {
        $(item).parents("div.alert").fadeOut();
    }
</script>