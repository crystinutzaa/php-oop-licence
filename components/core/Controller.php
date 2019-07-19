<?php

namespace app\components\core;

/**
 * Abstract class inherited by controllers
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
abstract class Controller extends Core
{
    
    /**
     * Call controller action
     * @param type $action
     * @throws \Exception
     */
    final public function callAction($action)
    {
        $actionName = 'action' . ucfirst($action);
        if (is_callable([$this, $actionName])) {
            $this->$actionName();
        } else {
            throw new \Exception("The action $actionName does not exist!");
        }
    }

    /**
     * Render a php view file
     * @param type $view
     * @param type $params
     */
    public function renderView($view, $params = [])
    {
        include __DIR__ . '/../../' .  $view . '.php';
    }

    /**
     * Redirect the browser to the specific router
     * @param type $route
     */
    public function redirectToRoute($controller, $action)
    {
        header("Location: index.php?controller=$controller&action=$action");
        die();
    }
}
