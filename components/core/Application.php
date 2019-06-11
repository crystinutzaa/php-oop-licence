<?php

namespace app\components\core;

/**
 * Singleton Application state
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class Application
{

    protected $_config;
    protected static $_app;

    /**
     * Construct singleton Application
     * To get an instance pleace call Application::getInstance()
     */
    private function __construct($config = [])
    {

        $this->_config = $config;
        Application::$_app = $this;
    }

    /**
     * Do not allow to close the current Application (keep it singleton)
     */
    private function __clone()
    {
        
    }

    /**
     * Do not allow to reinit all resources - keep it singleton
     */
    private function __wakeup()
    {
        
    }

    /**
     * Returns the current application 
     * @return self
     */
    public static function app()
    {

        return self::$_app;
    }

    /**
     * 
     * @param type $name
     * @return type
     */
    public function getConfig($name)
    {
        return $this->_config[$name];
    }

    /**
     * Get Singleton Instance of the Application
     * @staticvar type $instance
     * @param type $config
     * @return  $instance
     */
    public static function getInstance($config = [])
    {

        static $instance = null;

        if (null === $instance) {
            $instance = new static($config);
        }

        return $instance;
    }

    abstract public function run();
}
