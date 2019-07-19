<?php

namespace app\components\core;

/**
 * Connection Interface which will be implemented in all database connection classes
 * @author Soponar Cristina <crystinutzaa@gmail.com>
 */
interface ConnectionInterface
{

    /**
     *  Abstraction that force the instance implement the connection
     * @param type $config
     */
    public function connect($config);

    /**
     *  Abstraction that force the instance close the connection
     * @param type $params
     */
    public function close($params);
}
