<script type="text/javascript" src="<?= SITE_URL ?>public/admin/assets/js/addpost.js"></script>


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">افزودن پست جدید</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>


            <style>

                .bgColor {
                    max-width: 440px;
                    height: 400px;
                    background-color: #c3e8cb;
                    padding: 30px;
                    border-radius: 4px;
                    text-align: center;
                }

                #targetOuter {
                    position: relative;
                    text-align: center;
                    background-color: #F0E8E0;
                    margin: 20px auto;
                    width: 200px;
                    height: 200px;
                    border-radius: 4px;
                }

                .btnSubmit {
                    background-color: #565656;
                    border-radius: 4px;
                    padding: 10px;
                    border: #333 1px solid;
                    color: #FFFFFF;
                    width: 200px;
                    cursor: pointer;
                }

                .inputFile {
                    padding: 5px 0;
                    margin-top: 8px;
                    background-color: #FFFFFF;
                    width: 48px;
                    overflow: hidden;
                    opacity: 0;
                    cursor: pointer;
                }

                .icon-choose-image {
                    position: absolute;
                    opacity: 0.1;
                    top: 50%;
                    left: 50%;
                    margin-top: -24px;
                    margin-left: -24px;
                    width: 48px;
                    height: 48px;
                }

                .upload-preview {
                    border-radius: 4px;
                }

                #body-overlay {
                    background-color: rgba(0, 0, 0, 0.6);
                    z-index: 999;
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    display: none;
                }

                #body-overlay div {
                    position: absolute;
                    left: 50%;
                    top: 50%;
                    margin-top: -32px;
                    margin-left: -32px;
                }

                .dangers_test {
                    display: none;
                }

                .font-18 {
                    font-size: 18px;
                }

            </style>
            <div class="row">
                <div class="col-sm-12">

                    <form action="<?= SITE_URL ?>admin_posts/insert_post" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card-box">

                                    <?php
                                    if (!empty($_SESSION["save_post"]) and $_SESSION["save_post"] == "success") {
                                        ?>
                                        <div class="alert alert-success alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link">پست جدید با موفقیت ذخیره شد</a>
                                        </div>
                                    <?php }
                                    if (!empty($_SESSION["save_post"]) and $_SESSION["save_post"] == "danger") {
                                        ?>
                                        <div class="alert alert-danger alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link">مشکل در ذخیره پست !</a>
                                        </div>
                                    <?php }
                                    if (!empty($_SESSION["save_post"]) and $_SESSION["save_post"] == "empty") {
                                        ?>
                                        <div class="alert alert-warning alert-dismissable text-center">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                                ×
                                            </button>
                                            <a class="alert-link"> نام یا دسته پست نمیتواند خالی باشد !</a>
                                        </div>
                                    <?php }
                                    unset($_SESSION["save_post"]);
                                    ?>

                                    <div class="form-group m-b-20">
                                        <label>عنوان پست <span class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" placeholder="عنوان پست"
                                               name="title">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">انتخاب تصویر شاخص پست <span
                                                    class="text-danger">*</span></label>
                                        <input type="file" class="filestyle" data-buttonname="btn-white"
                                               id="filestyle-0" tabindex="-1" name="post_first_img"
                                               style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                        <div class="bootstrap-filestyle input-group">
                                            <input type="text" class="form-control " placeholder="" disabled="">
                                            <span class="group-span-filestyle input-group-btn" tabindex="0">
                                                 <label for="filestyle-0" class="btn btn-white ">
                                                     <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span>
                                                    <span class="buttonText">انتخاب فایل</span></label></span>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label>توضیحات پست <span class="text-danger">*</span></label>

                                        <textarea class="editor1" name="postcontent" id="editor1" cols="30" rows="10"
                                                  placeholder="محتوای مطلب" data-toggle="tooltip" data-placement="top">

                                        </textarea>

                                        <script>

                                            CKEDITOR.replace('editor1', {});

                                        </script>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label>انتخاب مجموعه ها <span class="text-danger">*</span></label>
                                        <select required class="form-control select2" name="category">
                                            <option value="">انتخاب کنید</option>
                                            <?php
                                            $site_categorys = $data["site_categorys"];
                                            print_r($site_categorys);
                                            foreach ($site_categorys as $category) {
                                                ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group m-b-20">
                                        <label class="m-b-15">وضعیت <span class="text-danger">*</span></label>
                                        <br/>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio1" value="active" name="status"
                                                   checked="">
                                            <label for="inlineRadio1"> فعال </label>
                                        </div>

                                        <div class="radio radio-inline">
                                            <input type="radio" id="inlineRadio2" value="inactive" name="status">
                                            <label for="inlineRadio2"> غیرفعال </label>
                                        </div>
                                    </div>

                                    <!--  =====  upload picture  ====  -->
                                    <div class="form-group">
                                        <h6 class="bg-warning dangers_test" style="padding: 5px">
                                            <span class="link font-18"></span>
                                        </h6>
                                        <h6 class="bg-warning dangers_test" style="padding: 5px">
                                            <span class="text-danger ">*</span>
                                            <span>لینک های بالا در جایی ثبت نخواهد شد. شما باید از این لینک ها در هر جایی از متن خبر که میخواهید استفاده کنید.</span>
                                        </h6>
                                        <div class="col-sm-12">
                                            <hr/>
                                            <div class="text-center p-20">
                                                <button type="submit"
                                                        class="btn w-sm btn-default waves-effect waves-light">ذخیره
                                                </button>
                                                <button type="reset"
                                                        class="btn w-sm btn-danger waves-effect waves-light">خالی کردن
                                                    فرم
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </form>
                </div>


            </div>
        </div>

        <div id="body-overlay">
            <div><img src="<?= SITE_URL ?>public\admin\images/loading.gif" width="64px" height="64px"/></div>
        </div>
        <div class="bgColor">
            <form id="uploadForm" action="<?= SITE_URL ?>admin_posts/ajax_upload_img" method="post">
                <div id="targetOuter">
                    <div id="targetLayer"></div>
                    <img src="<?= SITE_URL ?>public\admin\images/photo.png" class="icon-choose-image"/>
                    <div class="icon-choose-image">
                        <input name="userImage" id="userImage" type="file" class="inputFile"
                               onChange="showPreview(this);"/>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Upload Photo" class="btnSubmit"/>
            </form>
        </div>
    </div>

</div> <!-- content -->


<script type="text/javascript">
    function showPreview(objFileInput) {
        if (objFileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (e) {
                $("#targetLayer").html('<img src="' + e.target.result + '" width="200px" height="200px" class="upload-preview" />');
                $("#targetLayer").css('opacity', '0.7');
                $(".icon-choose-image").css('opacity', '0.5');
            };
            fileReader.readAsDataURL(objFileInput.files[0]);
        }
    }

    $(document).ready(function (e) {
        $("#uploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= SITE_URL ?>admin_posts/ajax_upload_img",
                type: "POST",
                data: new FormData(this),
                beforeSend: function () {
                    $("#body-overlay").show();
                },
                contentType: false,
                processData: false,
                success: function (data) {
                    $("span.link").html(data);
                    $("span.link").css('opacity', '1');
                    $(".dangers_test").css('display', 'block');
                    setInterval(function () {
                        $("#body-overlay").hide();
                    }, 500);
                },
                error: function () {
                }
            });
        }));
    });
</script>

