<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">مدیریت مطالب</h4>
                    <p class="text-muted page-title-alt"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-box">
                        <table class="table table-hover mails m-0 table table-actions-bar m-t-20">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th> متن پست</th>
                                <th>نام مجموعه</th>
                                <th>تعداد بازدید</th>
                                <th>تاریخ</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $site_posts = $data['site_posts'];
                            foreach ($site_posts as $item) {
                                ?>
                                <tr class="active">
                                    <td><?= $item["title"] ?></td>
                                    <td><?= $item["content"] ?></td>
                                    <td><?= $item["name"] ?></td>
                                    <td><?= $item["view_count"] ?></td>
                                    <td><?= $item["date"] ?></td>
                                    <td class="act_title"><?php if ($item['status'] == 'ACTIVE') {
                                            echo '<span style="color: #00c300"> فعال</span>';
                                        } elseif ($item['status'] == 'INACTIVE') {
                                            echo '<span style="color: #ff0e0e">غیر فعال</span>';
                                        } elseif ($item['status'] == 'DELETE') {
                                            echo '<span style="color: #ff0e0e"> حذف شده</span>';
                                        } ?>
                                    </td>
                                    <td>
                                        <!-- ========== delete ====== -->
                                        <a style="cursor: pointer"
                                           onclick="active_user(<?= $item['id'] ?>,this)"
                                           title="بازگردانی"
                                           class="table-action-btn ">
                                            <i class="btn btn-info btn-xs md md-undo "></i></a>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- content -->
    </div>

    <script>
        function active_user(id, item) {
            var url = "<?= SITE_URL ?>admin_posts/post_status_change";
            var data = {'id': id, 'status': "inactive"};
            $.post(url, data, function (msg) {
                if (msg == true) {
                    swal('با موفقیت بازگردانی  شد', ' ', 'success');
                    $(item).parents("tr").remove();
                } else {
                    swal("مشکل در ثبت !", " ", "error");
                }
            })
        }
    </script>

    <!--    <style>-->
    <!--        div.loder {-->
    <!--            width: 50px;-->
    <!--            height: 50px;-->
    <!--            background-color: inherit;-->
    <!--            border-radius: 100%;-->
    <!--            border-right: 5px solid #d3ba7f;-->
    <!--            border-left: 5px solid #d3ba7f;-->
    <!--            border-top: 5px solid #343434;-->
    <!--            border-bottom: 5px solid #343434;-->
    <!--            transition: transform 2s;-->
    <!--            -webkit-animation: load 2s linear infinite;-->
    <!--            -o-animation: load 2s linear infinite;-->
    <!--            animation: load 2s linear infinite;-->
    <!--        }-->
    <!---->
    <!--        @keyframes load {-->
    <!--            from {-->
    <!--                transform: rotate(0deg);-->
    <!--            }-->
    <!--            to {-->
    <!--                transform: rotate(360deg);-->
    <!--            }-->
    <!--        }-->
    <!--    </style>-->
    <!--    <div class="loder"></div>-->
