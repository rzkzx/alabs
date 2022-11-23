<?php
//TIMEZONE WITA
date_default_timezone_set("Asia/Ujung_Pandang");

// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'alabs');

//URL Root
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$name_server = explode("/", $_SERVER['PHP_SELF']);
define('URLROOT', $protocol . $_SERVER['HTTP_HOST'] . '/' . $name_server[1]);

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
