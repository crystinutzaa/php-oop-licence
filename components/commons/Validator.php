<?php

namespace app\components\commons;

/**
 * CsrfSecurity Class 
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Validator
{

    public static function isRequired($value)
    {
        if (!isset($value) || trim($value) == '') {
            return false;
        }
        return true;
    }

    public static function isEmail($value)
    {
        if (!isset($value) || trim($value) == '') {
            return false;
        }
        return (filter_var($value, FILTER_VALIDATE_EMAIL));
    }

    public static function isUrl($value)
    {
        if (!isset($value) || trim($value) == '') {
            return false;
        }
        return (filter_var($value, FILTER_VALIDATE_URL));
    }
}
