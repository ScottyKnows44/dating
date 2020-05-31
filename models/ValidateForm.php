<?php

class ValidateForm
{

    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);
    }

    function validAge($age)
    {
        return ($age > 18 && $age < 118);
    }

    function validPhone($number)
    {
        if (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $number)) {
            return true;
        }
        return false;
    }

    function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validOutdoor($outdoor)
    {
        if (empty($outdoor)) {
            return false;
        }

        return true;
    }

    function validIndoor($indoor)
    {
        if (empty($indoor)) {
            return false;
        }

        $validIndoor = getInDoorInterests();

        foreach ($indoor as $activity) {
            if (!in_array($activity, $validIndoor)) {
                return false;
            }
        }

        return true;
    }

}