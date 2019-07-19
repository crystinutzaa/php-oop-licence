<?php

namespace app\components\core;

/**
 * Class which allows to insert class data dynamically
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class Core
{
    private $data = [];

    public function loadData($attributes = [])
    {
        if (isset($attributes) && is_array($attributes)) {
            foreach ($attributes as $attribute => $value) {
                $this->$attribute = $value;
            }
        }
        return $this;
    }

    /**
     * Add attribute to the instance
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Get attribute of this instance
     * @param type $name
     * @return type
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    /**
     * Check if the attribute exists
     * @param type $name
     * @return type
     * @throws \OutOfRangeException
     */
    public function __isset($name)
    {
        if (!isset($this->data[$name])) {
            throw new \OutOfRangeException('Invalid name given');
        }
        return $this->data[$name];
    }

    /**
     * Unset model attribute
     * @param type $name
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }
}
