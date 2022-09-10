/**
 * Created by Programmer on 2017-07-12.
 */

var rootFolder = '';
switch (document.location.hostname) {
    case 'localhost' :
        rootFolder = window.location.protocol + '//' + document.location.hostname + '/italk';
        break;
    default :
        rootFolder = window.location.protocol + '//' + document.location.hostname;
        break;
}

function showhint() {
    var hint = '* تمامی اطلاعات مطالب سایت در بخش «مدیریت مطالب» قابل مشاهده و ویرایش است.';
    $('#ticketmodal-content').html('<div class="modal-body">' + hint + '</div>');
    $('myModal').modal('show');
}

function getcasevalues() {
    var posttype = $('#posttype').val();
    if (posttype == 2) {
        $('#typecase').html('');
    }
    else if (posttype == 1) {
        $('#casecontent').html('<div class="glyphicon glyphicon-refresh fa-spin"></div>');
        $.post(rootFolder + "/admin_ajaxdo/postmanage",
            {
                wtd: "getcollectionstoaddpost"
            },
            function (data, ajaxstatus) {
                arr = data.split('-');
                if (arr.constructor === Array) {
                    var subject = 'خطا';
                    var message = 'خطای ناشناخته';
                    var status = 'error';
                    if (arr[0] == 0) {
                        switch (arr[1]) {
                            case 'no choose':
                                message = 'هیچ گزینه ای انتخاب نشده است.';
                                break;
                            case 'wrong choose':
                                message = 'گزینه ی اشتباهی انتخاب شده است.';
                                break;
                            case 'no collections found':
                                message = 'هیچ مجموعه ای یافت نشد! ابتدا مجموعه ی خود را ایجاد کنید.';
                                break;
                            default:
                                message = data;
                                break;
                        }
                        swal(subject, message, status);
                        $('#typecase').html('');
                    }
                    else if (arr[0] == 1) {
                        $('#typecase').html(arr[1]);
                        $('select').addClass('form-control');
                        $('select').selectpicker('refresh');
                    }
                    else {
                        message = data;
                        swal(subject, message, status);
                        $('#typecase').html('');
                    }
                }
                else {
                    swal('خطا', data, 'error');
                    $('#typecase').html('');
                }
            });
    }
    else {
        $('#typecase').html('');
    }
}

function sendpost() {
    var pcontent = CKEDITOR.instances.postcontent.getData();
    pcontent = pcontent.replace(/&nbsp;/gi, " ");
    pcontent = encodeURIComponent(pcontent);
    var postsubject = $('#postsubject').val();
    var seosubject = $('#seosubject').val();
    var posttype = $('#posttype').val();
    var slideshow = ($('#slideshow').is(':checked')) ? '1' : '0';
    var casepost = '';
    if (pcontent == "") {
        swal('خطا', 'لطفا محتوای مطلب را وارد نمایید.', 'error');
        return false;
    }
    if (postsubject.length > 200) {
        swal('خطا', 'طول عنوان مطلب نمی تواند بیشتر از 200 کاراکتر باشد.', 'error');
        return false;
    }
    if (postsubject == "") {

        swal('خطا', 'لطفا عنوان مطلب را وارد نمایید.', 'error');
        return false;
    }
    if (posttype == 0 || posttype == '' || posttype == null) {
        swal('خطا', 'لطفا نوع مطلب را مشخص نمایید.', 'error');
        return false;
    }
    if (posttype == 1) {
        casepost = $('#casepost').val();
        if (typeof casepost === undefined || casepost == '' || casepost == 0 || casepost == null) {
            swal('خطا', 'لطفا مجموعه ی مربوط به این مطلب را انتخاب نمایید.', 'error');
            return false;
        }
    }
    $.post(rootFolder + "/admin_ajaxdo/postmanage",
        {
            wtd: "addpost",
            content: pcontent,
            subject: postsubject,
            seo: seosubject,
            posttype: posttype,
            casepost: casepost,
            slideshow: slideshow
        },
        function (data, ajaxstatus) {
            var arr = data.split('-');
            if (arr.constructor === Array) {
                var subject = 'خطا';
                var message = 'خطای ناشناخته';
                var status = 'error';
                if (arr[0] == 0) {
                    switch (arr[1]) {
                        case 'no choose':
                            message = 'هیچ گزینه ای انتخاب نشده است.';
                            break;
                        case 'wrong choose':
                            message = 'گزینه ی اشتباهی انتخاب شده است.';
                            break;
                        case 'seosubjectExists':
                            message = 'این نام مستعار در حال حاضر موجود است.';
                            break;
                        case 'notenteredvalues':
                            message = 'لطفا تمامی مقادیر را به درستی وارد نمایید.';
                            break;
                        case 'nocasechoose':
                            message = 'لطفا مجموعه ی مربوط به این مطلب را انتخاب نمایید.';
                            break;
                        case 'AddProblem':
                            message = 'متأسفانه در اضافه کردن مطلب مشکلی پیش آمده است. لطفا مجددا امتحان کنید و در صورت تکرار با پشتیبانی تماس بگیرید.';
                            break;
                        default:
                            message = data;
                            break;
                    }
                    swal(subject, message, status);
                }
                else if (arr[0] == 1) {
                    swal('موفق', 'مطلب «' + postsubject + '» با موفقیت اضافه شد.', 'success');
                }
                else {
                    message = data;
                    swal(subject, message, status);
                }
            }
            else {
                swal('خطا', data, 'error');
            }
        });
}

function upload_start() {
    $('#upload-process').css('visibility', 'visible');
    $('#upload-process').css('display', 'block');
    $('#uploadstatus').html('');
    $('#uploaderror').html('');
    return true;
}

function upload_end(check_upload, fileaddress) {
    if (check_upload == 1) {
        document.getElementById('filenamehere').innerHTML += " <i class='glyphicon glyphicon-check'></i> " + fileaddress + "<br>";
        document.getElementById('fileaddress').value = fileaddress;
        document.getElementById('uploaderror').innerHTML = "";
    }
    else if (check_upload == 2) {
        document.getElementById('filenamehere').innerHTML += "<i class='glyphicon glyphicon-remove'></i><br>";
        document.getElementById('uploaderror').innerHTML = "آپلود فایل بیش از حد مجاز طول کشید. لطفا مجددا امتحان کنید.";
    }
    else if (check_upload == 0) {
        document.getElementById('filenamehere').innerHTML += "<i class='glyphicon glyphicon-remove'></i><br>";
        document.getElementById('uploaderror').innerHTML = "فرمت یا حجم فایل مجاز نیست";
    }
    else if (check_upload == 3) {
        document.getElementById('filenamehere').innerHTML += "<i class='glyphicon glyphicon-remove'></i><br>";
        document.getElementById('uploaderror').innerHTML = "این فایل در حال حاضر وجود دارد. لطفا مجددا امتحان کنید. سیستم یک نام تصادفی برای آن تولید خواهد کرد.";
    }
    else {
        document.getElementById('filenamehere').innerHTML += "<i class='glyphicon glyphicon-remove'></i><br>";
        document.getElementById('uploaderror').innerHTML = "متأسفانه یک خطای ناشناخته ی سیستمی در آپلود فایل رخ داد! لطفا مجددا امتحان کنید و در صورت تکرار به پشتیبانی گزارش دهید.";
    }
    document.getElementById('upload-process').style.visibility = 'hidden';
    return true;
}
