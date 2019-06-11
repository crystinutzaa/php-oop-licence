<?php

namespace app\components\core;
use app\components\ModelError as ModelErrorCore;

/**
 * Abstract class that defines a object model
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class ObjectModel extends Core {

    public $errors = [];

     /**
     * Create object model
     */
    abstract  function init();
    
    /**
     * Find ObjectModel by id
     */
    abstract  function getById($id);

    /**
     * Delete object model by id
     */
    abstract function deleteById($id);
    
    /**
     * Save object model (create or update)
     */
    abstract function save();
    
    /**
     * get All Object Models
     */
    abstract function getAll();

    /**
     * Validate  object model
     */
    abstract function validate();
    

    /**
     * Add errors to object model
     * @param ModelErrorCore $error
     */
    public function addError(ModelErrorCore $error) {
        $this->errors[] = $error;
    }

    /**
     * Check if object model has errors
     * @return boolean
     */
    public function hasErrors() {
        if (count($this->errors) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Return errors
     * @return type
     */
    public function getErrors() {
        return $this->errors;
    }

}
