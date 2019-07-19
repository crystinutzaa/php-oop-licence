<?php

namespace app\components;

use app\components\core\Application as CoreApplication;
use app\components\core\Controller as CoreController;
use app\components\core\Router as BaseRouter;
use app\components\Router;

/**
 * Backbone class application - uses Core Singleton Application to control the application instances
 * Application class handles all requests and responsed for the whole app
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Application extends CoreApplication
{
    public $name = '';
    public $router;
    public $controller;

    /**
     * Start the application
     */
    public function run()
    {
        $this->load();

        $this->init();

        $this->process();

        $this->close();
    }

    /**
     * Load config from the config file /config/config.php
     */
    private function load()
    {
        $this->name = $this->_config['name'];
    }

    /**
     * Init the components and resolve the routes
     */
    private function init()
    {
        // Init all components
        if (is_array($this->_config['components'])) {
            foreach ($this->_config['components'] as $name => $component) {
                $className = $component['class'];
                if (!isset($className)) {
                    throw new \Exception("The class in componet {$name} must to be passed");
                }
                // Send the config to the new component (only specific configs)
                $initComponent = new $className($this->_config['components'][$name]);

                // Add the component on application instance.
                $this->$name = $initComponent;
                // Connect and run the component
                $this->$name->connect();
            }
        }
        // handle requests and got to route
        $this->resolveRoutes();
    }

    /**
     * Launch the action of controller
     */
    private function process()
    {
        $this->controller->callAction($this->router->getActionName());
    }

    /**
     * Close application by closing / ending each component
     */
    public function close()
    {
        // Get all configured components
        if (is_array($this->_config['components'])) {
            foreach ($this->_config['components'] as $name => $component) {
                // Close each component
                $this->$name->close();
            }
        }
    }

    /**
     * Create the router object and add that to the application instance
     * and delegate it to resolve the route of application.
     */
    private function resolveRoutes()
    {
        $router = new Router($this);
        $this->setRouter($router);
        // get controller name based on route
        $controllerName = $router->getControllerName();

        //  Create the controller instance dinamically
        $fileName = ucfirst($controllerName) . 'Controller.php';
        $className = "app\controllers\\" . ucfirst($controllerName) . 'Controller';
        $filePath = __DIR__ . '/../controllers/' . $fileName;
        require_once($filePath);
        if (!class_exists($className)) {
            throw new \Exception("Class $className not found!");
        }

        $controller = new $className();

        $this->setController($controller);
    }

    /**
     * Set the rounter instance on application instance to be delegate on the future.
     * @param BaseRouter $router
     */
    private function setRouter(BaseRouter $router)
    {
        $this->router = $router;
    }

    /**
     * Set the controller instance on application instance to be delegate on the future.
     * @param BaseController $controller
     */
    private function setController($controller)
    {
        $this->controller = $controller;
    }
}
