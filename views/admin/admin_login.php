<?php


?>

<div class="clearfix"></div>
<div class="wrapper-page ">
    <div class=" card-box ">
        <div class="panel-heading">
            <h3 class="text-center"> ورود به حساب <strong class="text-custom">
                    <br><br> <?= $site_options["site_name"] ?></strong></h3>
        </div>

        <!-- === alert for check username(mobile) and password === -->
        <div class="alert alert-danger  m-t-40 alert-dismissible hidden nok   alertsho" role="alert">
            <strong>اطلاعات وارد شده صحیح نمیباشد</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- === form inputs for insert mobile and password === -->
        <div class="panel-body">
            <form class="form-horizontal m-t-20" action="<?= SITE_URL ?>admin_login/check_login" method="post">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input name="username" class="form-control" type="text" minlength="4" maxlength="32" required=""
                               placeholder=" نام کاربری " onkeydown="check_login(event)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" class="form-control" type="password" minlength="4" maxlength="32"
                               required=""
                               placeholder="رمز ورود" onkeydown="check_login(event)">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <span class="btn btn-pink btn-block text-uppercase waves-effect waves-light"
                              onclick="check_login(this,'s')" onkeydown="check_login(this,'s')">
                            ورود
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function error_check(error) {
        $('div.nok').removeClass('hidden');
        $('div.nok').find('strong').text(error);
        $('div.nok').fadeIn(100);
        setTimeout(function () {
            $('div.alertsho').fadeOut(1000);
        }, 2000);
    }

    function check_login(e, s) {
        if (e.keyCode == 13 || s == 's') {
            var user = $('input[name=username]').val();
            var pas = $('input[name=password]').val();
            var error = '';


            if (user.length < 4) {
                error = 'طول نام کاربری یا رمز عبور نباید کمتر از 4 حرف باشد';
                error_check(error)
            } else {
                var username = user;
            }

            if (pas.length < 4) {
                error = 'طول نام کاربری یا رمز عبور نباید کمتر از 4 حرف باشد';
                error_check(error)
            } else {
                var password = pas;
            }

            if (error.length < 1) {
                var url = "<?= SITE_URL ?>admin_login/check_clerk_login";
                var data = {'username': username, 'password': password};
                $.post(url, data, function (msg) {
                    if (msg == true) {
                        window.location = '<?= SITE_URL ?>admin_panel';
                    } else if (msg == 'inactive') {
                        error = ' حساب کاربری شما غیر فعال میباشد !';
                        error_check(error)
                    } else {
                        error = ' نام کاربری یا رمز عبور نادرست است !';
                        error_check(error)
                    }
                })
            }
        }
    } //end function
</script>

