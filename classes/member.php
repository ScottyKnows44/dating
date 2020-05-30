<?php

class member
{
    private $_first;
    private $_last;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    public function __construct($first, $last, $age, $gender, $phone)
    {
        $this->setFirstName($last);
        $this->setLastName($last);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
    }

    public function setEmail($email){
        $this->_email = $email;
    }

    public function setState($state){
        $this->_state = $state;
    }

    public function setSeeking($seeking){
        $this->_seeking = $seeking;
    }

    public function setBio($bio){
        $this->_bio = $bio;
    }

    public function setFirstName($first){
        $this->_first = $first;
    }

    public function setLastName($last){
        $this->_last = $last;
    }

    public function setAge($age){
        $this->_age = $age;
    }

    public function setGender($gender){
        $this->_gender= $gender;
    }

    public function setPhone($phone){
        $this->_phone = $phone;
    }

    public function getFirst(){
       return $this->_first;
    }

    public function getLast(){
        return $this->_last;
    }

    public function getAge(){
        return $this->_age;
    }

    public function getGender(){
        return $this->_gender;

    }
    public function getEmail(){
        return $this->_email;
    }

    public function getPhone(){
        return $this->_phone;
    }

    public function getBio(){
        return $this->_bio;
    }

    public function getSeeking(){
        return $this->_seeking;
    }

    public function getState(){
        return $this->_state;
    }


}