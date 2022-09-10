<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 10:15 PM
 */
class App
{

    public $url;
    public $controller;
    public $method;
    public $model;
    public $param = [];

    function __construct()
    {

        //   ===   check nad filter and set url   ===
        if (!empty($_GET['url'])) {
            $this->url = $this->filter($_GET['url']);
        } else {
            $this->url = $this->filter('index');
        }

        //   ===   set controller   ===
        if (!empty($this->url[0])) {
            $this->controller = $this->url[0];
            unset($this->url[0]);
        } else {
            $this->controller = 'index';
        }

        //   ===   set method   ===
        if (!empty($this->url[1])) {
            $this->method = $this->url[1];
            unset($this->url[1]);
        } else {
            $this->method = 'index';
        }

        //   ===   pour old url array info  to param array for set again indexes   ===
        if (!empty($this->url)) {
            $this->param = array_values($this->url);
            unset($this->url);
        }

        //   =======   require controller  =======

        $controller_url = "controllers/$this->controller.php";
        if (file_exists($controller_url)) {
            $model_ob = new model;
            $access = $model_ob->check_access($this->controller);
            if ($access == true) {
                $_SESSION['last_page'] = $this->controller;
                unset($_SESSION['errors']['app_errors'][0]);
                require($controller_url);
                $controller_object = new $this->controller;
                $controller_object->model($this->controller);
                if (method_exists($controller_object, $this->method)) {
                    call_user_func_array([$controller_object, $this->method], $this->param);
                    unset($_SESSION['errors']['app_errors'][1]);
                } else {
                    $_SESSION['errors']['app_errors'][1] = "در صفحه  کنترلر، متد یا فانکشن پیدا نشد" . $this->method;
                    $errorpage_url = 'views/errors/404.php';
                    if (file_exists($errorpage_url)) {
                        require($errorpage_url);
                    } else {
                        echo $_SESSION['errors']['app_errors'][1];
                    }
                }
            } elseif ($access == false) {
                $_SESSION['errors']['app_errors'][0] = "در صفحه اپ فایل کنترلر پیدا نشد" . $controller_url;
                $errorpage_url = 'views/errors/403.php';
                if (file_exists($errorpage_url)) {
                    require($errorpage_url);
                } else {
                    echo $_SESSION['errors'];
                }
            }
        } else {
            $_SESSION['errors']['app_errors'][0] = "در صفحه اپ فایل کنترلر پیدا نشد" . $controller_url;
            $errorpage_url = 'views/errors/404.php';
            if (file_exists($errorpage_url)) {
                require($errorpage_url);
            } else {
                echo $_SESSION['errors'];
            }
        }
    }

    function filter($data)
    {
        $data = filter_var($data, FILTER_SANITIZE_URL);
        $data = trim(htmlspecialchars(stripcslashes($data)));
        $data = explode('/', $data);
        return $data;
    }
}
