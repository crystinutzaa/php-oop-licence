<?php

namespace app\classes;

use app\components\core\ObjectModel as ObjectModelCore;
use app\components\Application;
use app\components\commons\Validator;
use app\components\ModelError;

/**
 * Customer Class which extends the ObjectModelCore
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Customer extends ObjectModelCore
{
    /* Init the Customer Object with ObjectModelFactory */

    public function init()
    {
        return new Customer();
    }

    public function getAll()
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $customers = [];
        foreach ($rows as $row) {
            $customer = new Customer();
            $customer->loadData($row);
            $customers[] = $customer;
        }
        return $customers;
    }

    /**
     * Find ObjectModel by email
     */
    public function getByEmail($email)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer where email LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($email, FILTER_SANITIZE_EMAIL)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $customer = new Customer();
            $customer->loadData($row);
            return $customer;
        }
        return null;
    }

    /**
     * Find ObjectModel by id
     */
    public function getById($id_customer)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer where id_customer = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_customer, FILTER_SANITIZE_NUMBER_INT)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $customer = new Customer();
            $customer->loadData($row);
            return $customer;
        }
        return null;
    }

    /**
     * Delete object model by id
     */
    public function deleteById($id_customer)
    {
        $conn = Application::app()->db->conn;
        $sql = 'DELETE FROM customer WHERE id_customer = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_customer, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }

    /**
     * Validate  object model
     */
    public function validate()
    {
        if (!Validator::isRequired($this->name)) {
            $this->addError(new ModelError('name', 'Name is required'));
        }

        if (!Validator::isRequired($this->password)) {
            $this->addError(new ModelError('name', 'Password is required'));
        }

        if (!Validator::isEmail($this->email)) {
            $this->addError(new ModelError('name', 'Email is not valid'));
        }

        if ($this->hasErrors()) {
            return false;
        }

        return true;
    }

    /**
     * Save object model (create or update)
     */
    public function save()
    {
        if ($this->validate()) {
                $conn = Application::app()->db->conn;
                $sql = " INSERT INTO customer "
                    . " ( name, password, email ) "
                    . " VALUES  "
                    . " (?,?,?)";
                // USES prepared statements to avoid sql injection
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    // TO AVOID XSS ATTACKS, APPLY FILTERS
                    filter_var($this->name, FILTER_SANITIZE_STRING),
                    filter_var($this->password, FILTER_SANITIZE_STRING),
                    filter_var($this->email, FILTER_SANITIZE_STRING)
                ]);
                $this->id_customer = $conn->lastInsertId();
            } else {
                $con<?php

namespace app\classes;

use app\components\core\ObjectModel as ObjectModelCore;
use app\components\Application;
use app\components\commons\Validator;
use app\components\ModelError;

/**
 * Customer Class which extends the ObjectModelCore
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Customer extends ObjectModelCore
{
    /* Init the Customer Object with ObjectModelFactory */

    public function init()
    {
        return new Customer();
    }

    public function getAll()
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $customers = [];
        foreach ($rows as $row) {
            $customer = new Customer();
            $customer->loadData($row);
            $customers[] = $customer;
        }
        return $customers;
    }

    /**
     * Find ObjectModel by email
     */
    public function getByEmail($email)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer where email LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($email, FILTER_SANITIZE_EMAIL)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $customer = new Customer();
            $customer->loadData($row);
            return $customer;
        }
        return null;
    }

    /**
     * Find ObjectModel by id
     */
    public function getById($id_customer)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM customer where id_customer = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_customer, FILTER_SANITIZE_NUMBER_INT)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $customer = new Customer();
            $customer->loadData($row);
            return $customer;
        }
        return null;
    }

    /**
     * Delete object model by id
     */
    public function deleteById($id_customer)
    {
        $conn = Application::app()->db->conn;
        $sql = 'DELETE FROM customer WHERE id_customer = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_customer, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }

    /**
     * Validate  object model
     */
    public function validate()
    {
        if (!Validator::isRequired($this->name)) {
            $this->addError(new ModelError('name', 'Name is required'));
        }

        if (!Validator::isRequired($this->password)) {
            $this->addError(new ModelError('name', 'Password is required'));
        }

        if (!Validator::isEmail($this->email)) {
            $this->addError(new ModelError('name', 'Email is not valid'));
        }

        if ($this->hasErrors()) {
            return false;
        }

        return true;
    }

    /**
     * Save object model (create or update)
     */
    public function save()
    {
        if ($this->validate()) {
            if (!$this->id_customer) {
                $conn = Application::app()->db->conn;
                $sql = " INSERT INTO customer "
                    . " ( name, password, email ) "
                    . " VALUES  "
                    . " (?,?,?)";
                // USES prepared statements to avoid sql injection
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    // TO AVOID XSS ATTACKS, APPLY FILTERS
                    filter_var($this->name, FILTER_SANITIZE_STRING),
                    filter_var($this->password, FILTER_SANITIZE_STRING),
                    filter_var($this->email, FILTER_SANITIZE_STRING)
                ]);
                $this->id_customer = $conn->lastInsertId();
            } else {
                $conn = Application::app()->db->conn;
