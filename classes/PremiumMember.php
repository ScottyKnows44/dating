<?php

class PremiumMember
{
    private $_outDoorInterests;
    private $_inDoorInterests;

    public function __construct($indoor, $outdoor)
    {
     $this->setIndoorInterests($indoor);
     $this->setOutDoorInterests($outdoor);
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

}