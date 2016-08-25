<?php
date_default_timezone_set('PRC');
//mvc root path
define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']));
//mvc relative path
define("SITE_PATH", dirname($_SERVER['SCRIPT_NAME']));
//system setting and option path
define('APP_SYS_PATH', dirname(__FILE__));
define('APP_SITE_PATH', dirname(dirname(__FILE__)));
//global functions
require_once(APP_SYS_PATH."/functions.php");
//get mvc router
$route = get_mvc_route();
//controller
$mvc_ctrl = $route["c"];
//controller action
$mvc_act = $route["a"];
//controller name format : XxxController
$mvc_ctrl_name = $mvc_ctrl."_ctrl";
//load controller file
$mvc_ctrl_file = sprintf("%s/app/controller/%s.php",APP_PATH,$mvc_ctrl_name);
if(file_exists($mvc_ctrl_file)){
    //load base controller
    require_once APP_SYS_PATH."/controller.php";
    require_once $mvc_ctrl_file;
    $fakepfw_c = new $mvc_ctrl_name();
    //action before user
    $fakepfw_c->_before_action();
    //user action
    $fakepfw_c->{$mvcAction}();
    //action after user
    $fakepfw_c->_after_action();
}else{
    echo "Error! 404 page not found";
}
