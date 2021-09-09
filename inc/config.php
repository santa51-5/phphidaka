<?php

//define('DSN', 'mysql:dbname=db_koritsu1404;host=localhost;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'nao515mk_YUYA');
define('SITE_URL', 'http://localhost/m-phphidaka/');
//define('DB_USER', 'm-hidaka00001');
//define('DB_PASSWORD', '7cBdHyMW');
//define('SITE_URL', 'http://mm-system.m-hidaka.com/system2/');
//define('customer_id', 'mannou');

define('DSN_master', 'mysql:dbname=db_hmaster;host=localhost;charset=utf8');
//define('DSN_master', 'mysql:dbname=m-hidaka00001;host=localhost;charset=utf8');

error_reporting(E_ALL & ~E_NOTICE);
//session_set_cookie_params(1440, '/');
ini_set("memory_limit", "512M");
?>
