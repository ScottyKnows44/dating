<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('vendor/autoload.php');
require_once("models/data-layer.php");

session_start();
$f3 = Base::instance();
$validator = new ValidateForm();
$controller = new ControllerForm($f3, $validator);

$f3->route('GET / ', function(){
    $GLOBALS['controller']->home();
});

$f3->route('GET|POST /start ', function($f3){
    $GLOBALS['controller']->start();
});

$f3->route('GET|POST /start2 ', function ($f3){
    $GLOBALS['controller']->start2();
});

$f3->route('GET|POST /start3 ', function($f3){
    $GLOBALS['controller']->start3();
});

$f3->route('GET /summary ', function($f3){
    $GLOBALS['controller']->summary();
});

$f3-> run();
