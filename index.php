<?php
date_default_timezone_set("Asia/Tehran");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require('core/config.php');
require('core/App.php');
require('core/controller.php');
require('core/model.php');
new App;

