<?php

class ControllerForm
{

    private $_f3;
    private $_validateForm;

    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validateForm = $validator;
    }

    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function start()
    {
        $genders = getGender();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        var_dump($_POST);
        if (!$this->_validateForm->validName($_POST['first'])) {
            $this->_f3->set('errors["firstName"]', "Please enter a first name");
        }

        if (!$this->_validateForm->validName($_POST['last'])) {
            $this->_f3->set('errors["lastName"]', "Please enter a last name");
        }

        if (!$this->_validateForm->validAge($_POST['age'])) {
            $this->_f3->set('errors["ageError"]', "Please enter a valid age between 18 and 118");
        }

        $_SESSION['premium'] = $_POST['member'];

        if (empty($this->_f3->get('errors'))) {
            if($_POST['member'] =="yes"){
                $member = new PremiumMember($_POST['first'], $_POST['last'], $_POST['age'], $_POST['gender'], $_POST['phoneNumber']);
            } else{
                $member = new Member($_POST['first'], $_POST['last'], $_POST['age'], $_POST['gender'], $_POST['phoneNumber']);
            }
            $_SESSION['member'] = $member;
            $this->_f3->reroute('start2');
        }
}
        $this->_f3->set('genders', $genders);
        $this->_f3->set('selectedGender', $_POST['genders']);
        $view = new Template();
        echo $view->render('views/start.html');
}

public function start2()
{
    $states = getState();
    $interests = getInterests();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        var_dump($_POST);
        if (!$this->_validateForm->validEmail($_POST['email'])) {
            $this->_f3->set('errors["email"]', "Please enter a valid email");
        }

        if(empty($this->_f3->get('errors'))){
            $_SESSION['member']->setEmail($_POST['email']);
            $_SESSION['member']->setState($_POST['state']);
            $_SESSION['member']->setSeeking($_POST['preference']);
            $_SESSION['member']->setBio($_POST['bio']);

            if($_SESSION['member'] instanceof PremiumMember){
                $this->_f3->reroute('start3');
            } else{
                $this->_f3->reroute('summary');
            }
        }
    }

    $this->_f3->set('preferences', $interests);
    $this->_f3->set('selectedPreferred', $_POST['preference']);
    $this->_f3->set('states', $states);

    $view = new Template();
    echo $view->render('views/start2.html');

}


public function start3()
{
    $outdoors = getOutDoorInterests();
    $indoors = getInDoorInterests();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!$this->_validateForm->validIndoor($_POST['indoor'])) {
            $this->_f3->set('errors[inDoorError]', "Please select an indoor activity");
        }

        if (!$this->_validateForm->validOutdoor($_POST['outdoor'])) {
            $this->_f3->set('errors[outDoorError]', "Please select an outdoor activity");
        }

        if (empty($this->_f3->get('errors'))) {
            $_SESSION['member']->setOutDoorInterests($_POST['outdoor']);
            $_SESSION['member']->setIndoorInterests($_POST['indoor']);
            $this->_f3->reroute('summary');
        }
    }

    $this->_f3->set('indoors', $indoors);
    $this->_f3->set('outdoors', $outdoors);
    $this->_f3->set('selectedIndoors', $_POST['indoor']);
    $this->_f3->set('selectedOutdoors', $_POST['outdoor']);
    $view = new Template();
    echo $view->render('views/start3.html');
}

public function summary()
{
    $view = new Template();
    echo $view->render('views/summary.html');
    session_destroy();
}

}