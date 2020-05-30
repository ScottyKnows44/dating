<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('vendor/autoload.php');
require_once('models/data-layer.php');
require_once('models/Validation.php');

session_start();
$f3 = Base::instance();

$f3->route('GET / ', function(){
   $view = new Template();
   echo $view->render('views/home.html');
});

$f3->route('GET|POST /start ', function($f3){
    $genders = getGender();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if($_POST['member'] == "yes"){
            $member = new Member();
            $member->setFirstName($_POST['first']);
            $member->setLastName($_POST['last']);
            $member->setAge($_POST['age']);
            $member->setGender($_POST['gender']);
            $member->setPhone($_POST['phone']);
            $_SESSION['member'] = $member;
        }

        if(validName($_POST['first']) == false){
            $f3->set('errors["firstName"]', "Please enter a first name");
        }

        if(validName($_POST['last']) == false){
            $f3->set('errors["lastName"]', "Please enter a last name");
        }

        if(validAge($_POST['age']) == false){
            $f3->set('errors["ageError"]', "Please enter a valid age between 18 and 118");
        }

        if (empty($f3->get('errors'))) {
            $_SESSION['genders'] = $_POST['gender'];
            $_SESSION['first'] = $_POST['first'];
            $_SESSION['last'] = $_POST['last'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
            $f3->reroute('start2');
        }

    }

    $f3->set('genders', $genders);
    $f3->set('selectedGender', $_POST['gender']);
    $view = new Template();
    echo $view->render('views/start.html');
});

$f3->route('GET|POST /start2 ', function ($f3){

    $states = getState();
    $genders = getGender();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(validEmail($_POST['email']) == false){
            $f3->set('errors["email"]', "Please enter a valid email");
        }

        if (empty($f3->get('errors'))) {
            $_SESSION['genderPage2'] = $_POST['gender'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['bio'] = $_POST['bio'];
            $f3->reroute('start3');
        }
    }

    $f3->set('genders', $genders);
    $f3->set('selectedPreferred', $_POST['gender']);
    $f3->set('states', $states);
    $view = new Template();
    echo $view->render('views/start2.html');
});

$f3->route('GET|POST /start3 ', function($f3){
    $outdoors = getOutDoorInterests();
    $indoors = getInDoorInterests();



    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        var_dump($_POST);

        if(validIndoor($_POST['indoor']) == false){
            $f3->set('errors[inDoorError]', "Please select an indoor activity");
        }

        if(validOutdoor($_POST['outdoor']) == false){
            $f3->set('errors[outDoorError]', "Please select an outdoor activity");
        }

        if(empty($f3->get('errors'))){
            $_SESSION['indoor'] = $_POST['indoor'];
            $_SESSION['outdoor'] = $_POST['outdoor'];
            $f3->reroute('summary');
            session_destroy();
        }
    }

    $f3->set('indoors', $indoors);
    $f3->set('outdoors', $outdoors);
    $f3->set('selectedIndoors', $_POST['indoor']);
    $f3->set('selectedOutdoors', $_POST['outdoor']);
    $view = new Template();
    echo $view->render('views/start3.html');
});

$f3->route('GET /summary ', function($f3){
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3-> run();
