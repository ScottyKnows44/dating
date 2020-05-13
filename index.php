<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
require_once('vendor/autoload.php');
require_once('models/data-layer.php');

session_start();
$f3 = Base::instance();

$f3->route('GET / ', function(){
   $view = new Template();
   echo $view->render('views/home.html');
});

$f3->route('GET|POST /start ', function($f3){
    $genders = getGender();
    //var_dump($_POST);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['genders'] = $_POST['gender'];
        $_SESSION['first'] = $_POST['first'];
        $_SESSION['last'] = $_POST['last'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
        $f3->reroute('start2');
    }

    $f3->set('genders', $genders);

    $view = new Template();
    echo $view->render('views/start.html');
});

$f3->route('GET|POST /start2 ', function ($f3){

    $states = getState();
    $genders = getGender();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['genderPage2'] = $_POST['gender'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['bio'] = $_POST['bio'];
        $f3->reroute('start3');
    }

    $f3->set('genders', $genders);
    $f3->set('states', $states);
    $view = new Template();
    echo $view->render('views/start2.html');
});

$f3->route('GET|POST /start3 ', function($f3){
    $outdoors = getOutDoorInterests();
    $indoors = getInDoorInterests();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['indoor'] = $_POST['indoor'];
        $_SESSION['outdoor'] = $_POST['outdoor'];
        $f3->reroute('summary');
        session_destroy();
    }

    $f3->set('indoors', $indoors);
    $f3->set('outdoors', $outdoors);

    $view = new Template();
    echo $view->render('views/start3.html');
});

$f3->route('GET /summary ', function($f3){
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3-> run();
