<?php 
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, "es_MX.utf8");
ini_set('display_errors', '1');
error_reporting( E_ALL & ~E_NOTICE & ~E_WARNING);
require '/var/www/html/ElecNet/vendor/autoload.php';
use Mailgun\Mailgun;

$mg = Mailgun::create('5a42c51441529c5ecd79a98823ff314c-c8e745ec-ee39d9db');