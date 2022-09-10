<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">پیام ها</h4>
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
                                <?php $site_comments = $data["site_comments"];
                                foreach ($site_comments as $comment) {
                                    ?>
                                    <div class="p-20 p-t-0 col-xs-6">
                                        <div class="faq-box">
                                            <h4 class="question" data-wow-delay=".1s"><?= $comment["name"] ?></h4>
                                            <p class="answer"><?= $comment["comment"] ?></p>
                                            <span style="float: right;width: 50%;height: 1px;background-color: #efefef;margin:15PX 20%;"></span>
                                            <div class="table-box opport-box">

                                                <div class="table-detail">
                                                    <div class="member-info">
                                                        <p class="text-dark m-b-0"><b>زمان ثبت: </b>
                                                            <span class="text-muted"> <?= $comment["date"] . " , " . $comment["time"] ?></span>
                                                        </p>
                                                        <p class="text-dark m-b-5"><b>ایمیل:</b> <span
                                                                    class="text-muted"><?= $comment["email"] ?></span>
                                                        </p>
                                                        <p class="text-dark m-b-0"><b>شماره:</b> <span
                                                                    class="text-muted"><?= $comment["phone"] ?></span>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="table-detail">
                                                    <?php
                                                    if ($comment["status"] == "SEEN") {
                                                        ?>
                                                        <div class="table-detail lable-detail">
                                                            <span class="label label-success">خوانده شده</span>
                                                        </div>
                                                        <?php
                                                    } elseif ($comment["status"] == "NEW") {

                                                        ?>
                                                        <div class="table-detail lable-detail">
                                                            <span class="label label-danger">جدید</span>
                                                        </div>
                                                        <div class="table-detail table-actions-bar">
                                                            <a onclick="set_seen_comments(<?= $comment["id"] ?>)"
                                                               class="table-action-btn text-danger pointer"><i
                                                                        class=" glyphicon glyphicon-eye-open"></i></a>
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
            function set_seen_comments(comment_id) {
                var url = "<?= SITE_URL ?>admin_comments/set_seen_comments";
                var data = {"comment_id": comment_id};

                swal({
                    text: "",
                    title: "به حالت دیده شده تغییر پیدا کند؟",
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