<?php
$db_config['db_host']= 'localhost';
$db_config['db_user']= 'YOUR_DATABASE_USER';
$db_config['db_pass'] = 'YOUR_DATABASE_PASSWORD';
$db_config['db_name'] = 'shareposts';
foreach($db_config as $key => $value){
  define(strtoupper($key), $value);
}
// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'http://localhost/shareposts');
// Site Name
define('SITENAME', 'THE_SITE_NAME');
// version
define('VERSION', '1.0.0');
