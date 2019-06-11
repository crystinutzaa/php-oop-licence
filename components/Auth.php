<?php

namespace app\components;

use app\components\core\Auth as BaseAuth;
use app\components\ModelError;
use app\classes\Customer;
use app\components\core\Core;
use app\components\commons\Validator;

/**
 * Authentication & session handle Class
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Auth extends BaseAuth
{

    public static function init()
    {
        return new Auth();
    }

    public function validateLogin()
    {
        // TO DO : Add validation
        if (!Validator::isRequired($this->password)) {
            $this->addError(new ModelError('password', 'Password is required'));
        }
        if (!Validator::isEmail($this->email)) {
            $this->addError(new ModelError('email', 'Email is not valid'));
        }
        if ($this->hasErrors()) {
            return false;
        }

        return true;
    }

    public function validateCreateAccount()
    {
        // TO DO : Add validation
        if (!Validator::isRequired($this->name)) {
            $this->addError(new ModelError('name', 'Name is required'));
        }

        if (!Validator::isRequired($this->password)) {
            $this->addError(new ModelError('password', 'Password is required'));
        }
        if (!Validator::isEmail($this->email)) {
            $this->addError(new ModelError('email', 'Email is not valid'));
        }
        if ($this->hasErrors()) {
            return false;
        }

        return true;
    }

    /**
     * Login the user based on login and password parameters 
     * @return boolean
     */
    public function login()
    {
        if ($this->validateLogin()) {
            $customer = (new Customer())->getByEmail($this->email);
            if (isset($customer)) {
                $this->id_customer = $customer->id_customer;

                if (null !== $customer) {
                    if ($customer->password === $this->password) {
                        $this->setSession();
                        return true;
                    }
                }
            }
            $this->addError(new ModelError('username', 'Email or Password not found'));
            return false;
        }
        return false;
    }

    /**
     * Create customer account 
     * @return boolean
     */
    public function createAccount()
    {
        if ($this->validateCreateAccount()) {
            $customer = (new Customer())->getByEmail($this->email);
            if (isset($customer) && !empty($customer)) {
                $this->addError(new ModelError('username', 'Customer already exists'));
                return false;
            }

            $customer = new Customer();
            $customer->loadData(
                [
                    'email' => $this->email,
                    'name' => $this->name,
                    'password' => $this->password
                ]
            );
            if ($customer = $customer->save()) {
                $this->id_customer = $customer->id_customer;
                $this->setSession();
                return true;
            }
            $this->addError(new ModelError('username', 'Cannot create customer account'));
            return false;
        }
        return false;
    }

    /**
     * Check if the user is logged or not.
     * @return boolean
     */
    public function isLogged()
    {
        if (!isset($_SESSION['id_customer'])) {
            return false;
        }
        if (!isset($_SESSION['email'])) {
            return false;
        }
        if (!isset($_SESSION['password'])) {
            return false;
        }

        return true;
    }

    /**
     * Create Session within the parameters of auth.
     */
    private function setSession()
    {
        $_SESSION['id_customer'] = $this->id_customer;
        $_SESSION['email'] = $this->email;
        $_SESSION['password'] = $this->password;
    }

    /**
     * Returns the session based on the key
     * @param type $key
     * @return type
     */
    public function getSession($key)
    {
        return $_SESSION[$key];
    }

    /**
     * Kill the session instances.
     */
    public function logout()
    {
        unset($_SESSION['id_customer']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
    }
}
