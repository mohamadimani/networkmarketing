<?php

?>

<section class="container-fluid bglog">
    <section class="row">
        <section class="container">
            <section class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="login">
                        <div class="tab text-center">
                            <div class="tablinks dok" onclick="logintab(event, 'register')">ثبت نام</div>
                            <div class="tablinks dok1 active-form" onclick="logintab(event, 'login')">ورود</div>
                        </div>

                        <!--   register        -->
                        <div id="register" class="tabcontent">
                            <div class="quizform text-center">
                                <form action="#">
                                    <p class="rtl alert alert-danger"> شماره وارد شده نامعتبر میباشد </p>
                                    <p class="rtl alert alert-danger"> این شماره قبلا ثبت نام کرده است </p>

                                    <input type="text" id="num2" name="number" placeholder="شماره همراه">
                                    <input type="submit" value="ارسال کد " class="float-left">
                            </div>
                            <p class="text-center">لطفا پس از فعال سازی حساب کاربری خود را تکمیل کنید تا
                                <span class="introduce-code"> کد معرف </span> برای شما ارسال شود
                            </p>
                        </div>

                        <!--      login   -->
                        <div id="login" class="tabcontent activelog">
                            <div class="quizform text-center">
                                <form action="#">
                                    <p class="rtl alert alert-danger"> اطلاعات وارد شده صحیح نمیباشد </p>
                                    <input type="text" id="num3" name="number" placeholder="شماره ملی">
                                    <input type="password" id="pass" name="password" placeholder="رمز عبور">
                                    <input type="submit" value="ورود" class="float-left">
                                    <a class="forget-pass" style="margin-top: 30px;"> فراموشی رمز عبور </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>

