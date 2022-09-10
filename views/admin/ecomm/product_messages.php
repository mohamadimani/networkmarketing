<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">نظرات کاربران</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>
            <style>
                .faq-box {
                    border-bottom: 1px solid #8a9094 !important;
                }

                .pointer {
                    cursor: pointer;
                }
            </style>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <div class="row m-t-40">
                            <div class="col-xs-12">
                                <?php
                                if (!empty($data["all_messages"]) and is_array($data["all_messages"])) {
                                    $all_messages = $data["all_messages"];
                                } else {
                                    $all_messages = [];
                                }
                                foreach ($all_messages as $comment) {
                                    ?>
                                    <div class="p-20 p-t-0 col-xs-6">
                                        <div class="faq-box">
                                            <p class="answer"><?= $comment["message"] ?></p>
                                            <span style="float: right;width: 50%;height: 1px;background-color: #efefef;margin:15PX 20%;"></span>
                                            <div class="table-box opport-box">

                                                <div class="table-detail">
                                                    <div class="member-info">
                                                        <p class="text-dark m-b-0"><b>زمان ثبت: </b>
                                                            <span class="text-muted"><?= $comment["date"] ?></span>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="table-detail">
                                                    <?php
                                                    if ($comment["status"] == "ACTIVE") {
                                                        ?>
                                                        <div class="table-detail lable-detail">
                                                            <span class="label label-success">فعال</span>
                                                        </div>
                                                        <?php
                                                    } elseif ($comment["status"] == "INACTIVE") {

                                                        ?>
                                                        <div class="table-detail lable-detail">
                                                            <span class="label label-danger">جدید</span>
                                                        </div>
                                                        <div class="table-detail table-actions-bar">
                                                            <a onclick="set_seen_comments(<?= $comment["id"] ?>)"
                                                               class="table-action-btn text-danger pointer">
                                                                <i class=" glyphicon glyphicon-eye-open"
                                                                   title="فعال کردن"></i></a>
                                                        </div>
                                                        <?php
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- content -->
        </div>


        <script>
            function set_seen_comments(message_id) {
                var url = "<?= SITE_URL ?>admin_ecomm_products/set_seen_message";
                var data = {"message_id": message_id};

                swal({
                    text: "",
                    title: "در سایت منتشر شود؟",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "بله",
                    cancelButtonText: "لغو",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.post(url, data, function (msg) {
                            if (msg == true) {
                                location.reload()
                            }
                        });
                    }
                });

//                swal({
//                        title: title,
//                        text: "به حالت دیده شده تغییر پیدا کند؟",
//                        type: "warning",
//                        showCancelButton: true,
//                        confirmButtonClass: "btn-danger",
//                        confirmButtonText: "بله",
//                        cancelButtonText: "خیر",
//                        closeOnConfirm: true,
//                        closeOnCancel: true
//                    },
//                    function (isConfirm) {
//                        if (isConfirm) {
//                            swal("SS", " ", "success");
//                        } else {
//                            swal("لغو شد", " ", "error");
//                        }
//                    });
            }
        </script>