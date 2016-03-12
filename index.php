<?php
require_once 'config.php';

define('ROOT_PATH', __DIR__);

//$db = new MysqliDb (Array (
//        'host' => HOST,
//        'username' => USERNAME,
//        'password' => PASSWORD,
//        'db'=> DATABASE,
//        'port' => PORT,
//        'prefix' => PREFIX,
//        'charset' => CHARSET)
//);

//$host_name  = HOST;
//$database   = DATABASE;
//$user_name  = USERNAME;
//$password   = PASSWORD;
//
//$db = mysqli_connect($host_name, $user_name, $password, $database);

$controllerName = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'StandardController';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClassName = '\Fbreuer\Cms\Controller\\' . $controllerName;
$db = "";
$controller = new $controllerClassName($db);

if (!method_exists($controller, $action . 'Action')) {
    //throw new Exception('Unkown method/controller');
    $action = "wrongController";
    call_user_func(array($controller, $action . 'Action'));
}else{
    call_user_func(array($controller, $action . 'Action'));
}