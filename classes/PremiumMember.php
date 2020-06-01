<?php

class PremiumMember extends Member
{
    private $_outDoorInterests;
    private $_inDoorInterests;

    public function __construct($first, $last, $age, $gender = "", $phone = "")
    {
        $this->setFirstName($first);
        $this->setLastName($last);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
    }

    public function setIndoorInterests($indoor){
        $this->_inDoorInterests = $indoor;
    }

    public function setOutDoorInterests($outdoor){
        $this->_outDoorInterests = $outdoor;
    }

    public function getOutDoorInterests(){
        return $this->_outDoorInterests;
    }

    public function getInDoorInterests(){
        return $this->_inDoorInterests;
    }

    public function toStringInDoor()
    {
        $out = "";

        if (!empty($this->_inDoorInterests)) {
            $out .= implode(" & ", $this->_inDoorInterests);
        }
        return $out;
    }

    public function toStringOutDoor(){
        $out = "";

        if(!empty($this->_outDoorInterests)){
            $out .= implode(" & ", $this->_outDoorInterests);
        }
        return $out;
    }


}