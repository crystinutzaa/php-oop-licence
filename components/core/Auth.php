<?php

namespace app\components\core;

use app\components\core\ModelError;

/**
 * Authentication Class
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class Auth extends Core
{

    /**
     * Errors array
     * @var type 
     */
    protected $errors = [];

    abstract public function login();

    abstract public function isLogged();

    abstract public function logout();

    /**
     * Add error
     * @param ModelError $error
     */
    protected function addError(ModelError $error)
    {
        $this->errors[] = $error;
    }

    /**
     * Check if there is erros attached within this model
     * @return boolean
     */
    public function hasErrors()
    {
        if (count($this->errors) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Get errors array
     * @return type
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
