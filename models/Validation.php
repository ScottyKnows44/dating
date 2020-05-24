<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

function validName($name)
{
    return ctype_alpha($name);
}
function validAge($age)
{
    return ($age > 18 && $age< 118);
}

function validPhone($number)
{
    if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $number)) {
        return true;
    }
    return false;
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validOutdoor($outdoor)
{
    if($outdoor == ""){
        return false;
    }
    $realOutdoors = getOutDoorInterests();
    for($i = 0; $i < sizeof($outdoor); $i++){
        for ($x=0; $x < sizeof($realOutdoors); $x++ ){
            if($realOutdoors[$x] !== $outdoor[$i]){
                return false;
            }
        }
    }
    return false;
}

function validIndoor($indoor)
{
    if($indoor == ""){
        return false;
    }
    $realIndoors = getInDoorInterests();
    for($i = 0; $i < sizeof($indoor); $i++){
        for ($x=0; $x < sizeof($realIndoors); $x++ ){
            if($realIndoors[$x] !== $indoor[$i]){
                return false;
            }
        }
    }
    return false;
}