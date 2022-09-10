<?php
/**
 * Created by PhpStorm.
 * User: mani
 * Date: 01/15/2019
 * Time: 04:07 PM
 */


?>

<footer>
    <section class="container">
        <section class="foot">
            <section class="row">
                <section class="col-md-4 lists">
                    <h4> ارتباط با ما </h4>
                    <hr style="border-color: #888">
                    <p><i class="fas fa-map-marker-alt"></i> تهران میدان انقلاب خیابان کارگر شمالی خیابان دوم غربی پلاک
                        ۶ طبقه همکف </p>
                    <p><i class="fas fa-phone"></i> تلفن : ۸۸۳۴۶۹۶۲</p>

                    <a href="#" class="links"> <i class="fab fa-telegram"
                                                  style="font-size: 30px; margin-right: 10px;"></i> </a>
                    <a href="#" class="links"> <i class="fab fa-facebook"
                                                  style="font-size: 30px; margin-right: 10px;"></i> </a>
                    <a href="#" class="links"> <i class="fab fa-instagram"
                                                  style="font-size: 30px; margin-right: 10px;"></i> </a>
                    <a href="#" class="links"> <i class="far fa-envelope"
                                                  style="font-size: 30px; margin-right: 10px;"></i></a>

                </section>
                <section class="col-md-4 lists">
                    <h4> عنوان سایت </h4>
                    <hr style="border-color: #888">
                    <ul>
                        <a class="textfoot" href="news2.html">
                            <li> صفحه نخست

                            </li>
                        </a>
                        <a class="textfoot" href="lab2.html">
                            <li>بازاریابی شبکه ای</li>
                        </a>
                        <a class="textfoot" href="lab2.html">
                            <li>بازاریابی نقطه ای</li>
                        </a>
                        <a class="textfoot" href="contactus2.html">
                            <li> محصولات</li>
                        </a>
                        <a class="textfoot" href="lab2.html">
                            <li> قوانین و مقررات بازاریابی</li>
                        </a>
                    </ul>
                </section>
                <section class="col-md-4 lists">

                    <form action="#">
                        <input type="text" id="fname" name="firstname" placeholder="نام و نام خانوادگی">
                        <input type="text" id="lname" name="email" placeholder="ایمیل">

                        <textarea id="subject" name="subject" placeholder="نظرات و پیشنهادات"></textarea>

                        <input type="submit" value="ارسال" class="float-left">
                    </form>

                </section>

            </section>

        </section>

    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 law">
                <a class="farahoosh" href="http://imtit.ir" target="_blank"> طراحی و توسعه توسط شرکت فناوری ریزپردازنده
                    فراهوش </a>
            </div>
        </div>
    </div>

</footer>

<script src="<?= SITE_URL ?>public/web/js/script.js"></script>
<script src="<?= SITE_URL ?>public/web/assets/js/jquery.min.js"></script>
<script src="<?= SITE_URL ?>public/web/assets/js/bootstrap.min.js"></script>
<script src="<?= SITE_URL ?>public/web/assets/js/jquery-latest.min.js"></script>
<script src="<?= SITE_URL ?>public/web/assets/fontawesome-free-5.9.0-web/js/all.min.js"></script>
<script src="<?= SITE_URL ?>public/web/assets/js/home.js"></script>

<script>
    function logintab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active-form", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active-form";
    }
</script>
</body>
</html>

