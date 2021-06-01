<?php 
//load config file
require_once 'config/config.php';
// load helpers
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';
//autoload Core Libraries 
function autoloader($className){
    require_once APPROOT.'/libraries/'.$className.'.php';
}
spl_autoload_register('autoloader');
