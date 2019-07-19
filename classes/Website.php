<?php

namespace app\classes;

use app\components\core\ObjectModel as ObjectModelCore;
use app\components\Application;
use app\components\commons\Validator;
use app\components\ModelError;

/**
 * Website Class which extends the ObjectModelCore
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Website extends ObjectModelCore
{
    /* Init the Website Object with ObjectModelFactory */

    public function init()
    {
        return new Website();
    }

    public function getAll()
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM website";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $websites = [];
        foreach ($rows as $row) {
            $website = new Website();
            $website->loadData($row);
            $websites[] = $website;
        }
        return $websites;
    }

    /**
     * Find ObjectModel by id
     */
    public function getByIdCustomer($id_customer)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM website where id_customer = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_customer, FILTER_SANITIZE_NUMBER_INT)
        ]);
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $websites = [];
        foreach ($rows as $row) {
            $website = new Website();
            $website->loadData($row);
            $websites[] = $website;
        }
        return $websites;
    }

    /**
     * Find ObjectModel by id
     */
    public function getById($id_website)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM website where id_website = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_website, FILTER_SANITIZE_NUMBER_INT)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $website = new Website();
            $website->loadData($row);
            return $website;
        }
        return null;
    }

    /**
     * Delete object model by id
     */
    public function deleteById($id_website)
    {
        $conn = Application::app()->db->conn;
        $sql = 'DELETE FROM website WHERE id_website = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id_website, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }

    /**
     * Validate  object model
     */
    public function validate()
    {
        if (!Validator::isUrl($this->url)) {
            $this->addError(new ModelError('url', 'URL is not valid'));
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
            if (!$this->id_website) {
                $conn = Application::app()->db->conn;
                $sql = " INSERT INTO website "
                    . " ( id_customer, url ) "
                    . " VALUES  "
                    . " (?,?)";
                // USES prepared statements to avoid sql injection
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    // TO AVOID XSS ATTACKS, APPLY FILTERS
                    filter_var($this->id_customer, FILTER_SANITIZE_NUMBER_INT),
                    filter_var($this->url, FILTER_SANITIZE_URL)
                ]);
                $this->id_website = $conn->lastInsertId();
            } else {
                $conn = Application::app()->db->conn;
                $sql = " UPDATE website SET "
                    . " url=? "
                    . " WHERE id_website=?;";
                // USES prepared statements to avoid sql injection
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    // TO AVOID XSS ATTACKS, APPLY FILTERS
                    filter_var($this->url, FILTER_SANITIZE_URL),
                    filter_var($this->id_website, FILTER_SANITIZE_NUMBER_INT)
                ]);
            }

            return true;
        }
        return false;
    }
}
