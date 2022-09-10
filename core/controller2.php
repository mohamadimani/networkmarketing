<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 10:16 PM
 */
class controller
{

    public $model;

    function __construct()
    {
    }

//   ===   require view  ===
    function admin_view($url = '', $data = [], $header = '', $footer = '')
    {
        if (empty($header)) {
            $header_url = 'views/admin/header.php';
            if (file_exists($header_url)) {
                require($header_url);
                unset($_SESSION['errors']['controller_errors'][4]);
            } else {
                $_SESSION['errors']['controller_errors'][4] = "در صفحه کنترلر فایل header_admin پیدا نشد" . $header_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][4];
                }
            }
        }

        $url = "views/$url.php";
        if (file_exists($url)) {
            require($url);

            unset($_SESSION['errors']['controller_errors'][6]);
        } else {
            $_SESSION['errors']['controller_errors'][6] = "در صفحه کنترلر فایل ویو ادمین  پیدا نشد" . $url;
            $view_url = 'views/errors/404.php';
            if (file_exists($view_url)) {
                require($view_url);
            } else {
                echo $_SESSION['errors']['controller_errors'][6];
            }
        }
        if (empty($footer)) {
            $footer_url = 'views/admin/footer.php';
            if (file_exists($footer_url)) {
                require($footer_url);

                unset($_SESSION['errors']['controller_errors'][5]);
            } else {
                $_SESSION['errors']['controller_errors'][5] = "در صفحه کنترلر فایل footer_admin پیدا نشد" . $footer_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][5];
                }
            }
        }
    }

//   ===   require view  ===
    function user_view($url = '', $data = [], $header = '', $footer = '')
    {
        $this->model("headers");
        $user_info = $this->model->get_user_info();

        if (empty($header)) {
            $header_url = 'views/user/header.php';
            if (file_exists($header_url)) {
                unset($_SESSION['errors']['controller_errors'][04]);
                require($header_url);

            } else {
                $_SESSION['errors']['controller_errors'][04] = "در صفحه کنترلر فایل header user پیدا نشد" . $header_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][04];
                }
            }
        }
        $url = "views/user/$url.php";
        if (file_exists($url)) {
            require($url);

            unset($_SESSION['errors']['controller_errors'][06]);
        } else {
            $_SESSION['errors']['controller_errors'][06] = "در صفحه کنترلر فایل ویو user  پیدا نشد" . $url;
            $view_url = 'views/errors/404.php';
            if (file_exists($view_url)) {
                require($view_url);
            } else {
                echo $_SESSION['errors']['controller_errors'][06];
            }
        }
        if (empty($footer)) {
            $footer_url = 'views/user/footer.php';
            if (file_exists($footer_url)) {
                require($footer_url);
                unset($_SESSION['errors']['controller_errors'][05]);
            } else {
                $_SESSION['errors']['controller_errors'][05] = "در صفحه کنترلر فایل footer user پیدا نشد" . $footer_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][05];
                }
            }
        }
    }

//   ===   require view  ===
    function view($url = '', $data = [], $header = '', $footer = '')
    {
        if (empty($header)) {
            $header_url = 'views/web/header.php';
            if (file_exists($header_url)) {
                require($header_url);

                unset($_SESSION['errors']['controller_errors'][2]);
            } else {
                $_SESSION['errors']['controller_errors'][2] = "در صفحه کنترلر فایل header پیدا نشد" . $header_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][2];
                }
            }
        }

        $url = "views/$url.php";
        if (file_exists($url)) {
            require($url);
            unset($_SESSION['errors']['controller_errors'][1]);
        } else {
            $_SESSION['errors']['controller_errors'][1] = "در صفحه کنترلر فایل ویو پیدا نشد" . $url;
            $view_url = 'views/errors/404.php';
            if (file_exists($view_url)) {
                require($view_url);
            } else {
                echo $_SESSION['errors']['controller_errors'][1];
            }
        }

        if (empty($footer)) {
            $footer_url = 'views/web/footer.php';
            if (file_exists($footer_url)) {
                require($footer_url);

                unset($_SESSION['errors']['controller_errors'][3]);
            } else {
                $_SESSION['errors']['controller_errors'][3] = "در صفحه کنترلر فایل footer پیدا نشد" . $footer_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][3];
                }
            }
        }
    }

//   ===   require view  ===
    function ecomm_view($url = '', $data = [], $header = '', $footer = '')
    {
        $this->model("headers");
        $user_info = $this->model->get_user_info();
        $ecomm_menu = $this->model->get_ecomm_menu();
        $ecomm_category = $this->model->get_ecomm_category();

        if (empty($header)) {
            $header_url = 'views/ecomm/header.php';
            if (file_exists($header_url)) {
                require($header_url);

                unset($_SESSION['errors']['controller_errors'][2]);
            } else {
                $_SESSION['errors']['controller_errors'][2] = "در صفحه کنترلر فایل header پیدا نشد" . $header_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][2];
                }
            }
        }
        $url = "views/ecomm/$url.php";
        if (file_exists($url)) {
            require($url);
            unset($_SESSION['errors']['controller_errors'][1]);
        } else {
            $_SESSION['errors']['controller_errors'][1] = "در صفحه کنترلر فایل ویو پیدا نشد" . $url;
            $view_url = 'views/errors/404.php';
            if (file_exists($view_url)) {
                require($view_url);
            } else {
                echo $_SESSION['errors']['controller_errors'][1];
            }
        }
        if (empty($footer)) {
            $footer_url = 'views/ecomm/footer.php';
            if (file_exists($footer_url)) {
                require($footer_url);

                unset($_SESSION['errors']['controller_errors'][3]);
            } else {
                $_SESSION['errors']['controller_errors'][3] = "در صفحه کنترلر فایل footer پیدا نشد" . $footer_url;
                $view_url = 'views/errors/404.php';
                if (file_exists($view_url)) {
                    require($view_url);
                } else {
                    echo $_SESSION['errors']['controller_errors'][3];
                }
            }
        }
    }

//   ===   require model  ===
    function model($model = '')
    {
        $model_url = 'models/model_' . $model . '.php';
        if (file_exists($model_url)) {
            require($model_url);
            $classname = "model_" . $model;
            $this->model = new $classname;
            unset($_SESSION['errors']['controller_errors'][0]);
        } else {
            $_SESSION['errors']['controller_errors'][0] = "در صفحه کنترلر فایل مادل پیدا نشد" . $model_url;
            $controller_url = 'views/errors/404.php';
            if (file_exists($controller_url)) {
                require($controller_url);
            } else {
                echo $_SESSION['errors']['controller_errors'][0];
            }
        }
    }

}



