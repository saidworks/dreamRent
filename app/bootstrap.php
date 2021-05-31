<?php 
//load config file
require_once 'config/config.php';

//autoload Core Libraries 
function autoloader($className){
    require_once APPROOT.'/libraries/'.$className.'.php';
}
spl_autoload_register('autoloader');
