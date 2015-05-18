<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use Martin\components\Runtime\Runtime;

class Container
{
    static public $components;
    public function __construct()
    {
        $this->components['runtime'] = new Runtime();
    }
    public static function get($componentName, $componentClass)
    {
        if (!isset(self::$components['runtime'])) self::$components['runtime'] = new Runtime();
        if (!isset(self::$components[$componentName])) {
            $config = (isset(self::$components['runtime']->config['components'][$componentName])) ?
                self::$components['runtime']->config['components'][$componentName] : null;
            self::$components[$componentName]
                = new $componentClass($config);
        }
        return self::$components[$componentName];
    }

}

