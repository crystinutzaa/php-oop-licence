<?php

namespace app\components\core;

/**
 * Abstract class for Error
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class ModelError
{

    /**
     * Name of field of the model associeted
     * @var type
     */
    public $attribute;

    /**
     * Text of error message
     * @var type
     */
    public $message;

    /**
     * Contruct the error passing attribute and message
     * @param type $attribute
     * @param type $message
     */
    public function __construct($attribute, $message)
    {
        $this->attribute = $attribute;
        $this->message = $message;
    }
}
