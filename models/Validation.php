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
    if(empty($outdoor)){
        return false;
    }

    $validOutdoor = getOutDoorInterests();

    foreach ($validOutdoor as $activity){
        if(!in_array($activity, $outdoor)){
            return false;
        }
    }
    return true;
}

function validIndoor($indoor)
{
    if(empty($indoor)){
        return false;
    }

    $validIndoor = getInDoorInterests();

    foreach ($validIndoor as $activity){
        if(!in_array($activity, $indoor)){
            return false;
        }
    }
    return true;
}