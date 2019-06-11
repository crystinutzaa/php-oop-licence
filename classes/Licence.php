<?php

namespace app\classes;

use app\components\core\ObjectModel as ObjectModelCore;
use app\components\Application;

/**
 * Customer Class which extends the ObjectModelCore
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Licence extends ObjectModelCore
{
    /* Init the Licence Object with ObjectModelFactory */

    public function init()
    {
        return new Licence();
    }

    public function getAll()
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM licence";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $licences = [];
        foreach ($rows as $row) {
            $licence = new Licence();
            $licence->loadData($row);
            $licences[] = $licence;
        }
        return $licences;
    }

    /**
     * Find ObjectModel by id
     */
    public function getById($id)
    {
        $conn = Application::app()->db->conn;
        $sql = "SELECT * FROM licence where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id, FILTER_SANITIZE_NUMBER_INT)
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (null != $row) {
            $licence = new Licence();
            $licence->loadData($row);
            return $licence;
        }
        return null;
    }

    /**
     * Delete object model by id
     */
    public function deleteById($id)
    {
        $conn = Application::app()->db->conn;
        $sql = 'DELETE FROM licence WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            // TO AVOID XSS ATTACKS, APPLY FILTERS
            filter_var($id, FILTER_SANITIZE_NUMBER_INT)
        ]);
    }

    /**
     * Validate  object model
     */
    public function validate()
    {
        // TO DO : Add validation
        return true;
    }

    /**
     * Save object model (create or update)
     */
    public function save()
    {
        
    }
}
