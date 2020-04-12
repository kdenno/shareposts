<?php
// Load config 
require_once 'config/config.php';
// Load helpers
require_once 'helpers/redirect.php';
require_once 'helpers/sessionhelper.php';

 // Auto Load Libraries
 spl_autoload_register(function($className){
  require_once 'libraries/'.$className.'.php';
 })

?>