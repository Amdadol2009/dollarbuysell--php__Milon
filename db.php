<?php
$db_host = 'localhost';
$db_name = 'dollarbuysell--php';
$db_username = 'root';
$db_password = '';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name) or die("can not connect to database");
$mysqli->set_charset("utf8");

define('IS_LIVE', false);

define('SITE_TITLE', '24x7 Exchange (BD)');

define('BASE_URL', IS_LIVE ? 'https://dollarbuysellbd.com/' : 'http://localhost/dollarbuysell--php_Milon/');
define('IMAGE_ROOT', BASE_URL);
