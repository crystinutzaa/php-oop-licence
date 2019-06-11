<?php

namespace app\components;

use app\components\core\Router as CoreRouter;

/**
 * Class which will resolve the requests finding the controller and action
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
class Router extends CoreRouter
{

    public function __construct($app)
    {
        parent::__construct($app);
        /**
         * If there are other routes except /index.php?controller=controllerName&action=actionName
         * Add in here
         */
    }
}
