<?php

namespace app\components\core;

/**
 * Abstract class that defines a router: controller and action which will be mapped
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class Router
{

    /**
     * Current controller which will be used based on the current route
     * @var type 
     */
    private $controllerName;

    /**
     * Name of action class that will be called further
     * @var type 
     */
    private $actionName;

    /**
     * URL router mapping: /index.php?controller=controllerName&action=actionName
     * @param type $app
     * @throws \Exception
     */
    public function __construct($app)
    {

        if (isset($_GET['controller'])) {
            $controllerName = $_GET['controller'];
        }
        if (isset($_GET['action'])) {
            $actionName = $_GET['action'];
        }
        if (!isset($controllerName)) {
            // If no controller then get the default controller and action: index controller & index action            
            $controllerName = $app->getConfig('defaultController');
            $actionName = $app->getConfig('defaultAction');
        }
        if (!isset($actionName)) {
            throw new \Exception('Route is missing');
        }

        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    /**
     * Return the name of controller class
     * @return type
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * Return the name of action class
     * @return type
     */
    public function getActionName()
    {
        return $this->actionName;
    }
}
