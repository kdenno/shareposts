<?php
$db_config['db_host']= 'localhost';
$db_config['db_user']= '_YOUR_USERNAME';
$db_config['db_pass'] = 'YOUR_DATABASE_PASSWORD';
$db_config['db_name'] = 'YOUR_DATABASE_NAME';
foreach($db_config as $key => $value){
  define(strtoupper($key), $value);
}
// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'SITE_URL');
// Site Name
define('SITENAME', 'SITE_NAME');
