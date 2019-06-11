<?php

namespace app\components\commons;

/**
 * CsrfSecurity Class 
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class CsrfSecurity
{

    static function setCsrfSession($csrfToken)
    {
        $_SESSION['csrfToken'] = $csrfToken;
    }

    static function getCsrfSession()
    {
        return $_SESSION['csrfToken'];
    }

    /**
     * Generate Token on every request
     * @return type
     */
    static function generateCsrfToken()
    {
        if (!session_id()) {
            session_start();
        }
        $sessionId = session_id();
        $token = sha1(uniqid() . $sessionId);
        self::setCsrfSession($token);
        return $token;
    }

    /**
     * check CSRF token
     * 
     */
    static function checkCsrfToken($token)
    {
        return $token === self::getCsrfSession();
    }
}
