<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace application\custom;

use Martin\Container;

class Controller extends \Martin\Controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function __destruct()
    {
        parent::__destruct();
        App::debugger()->inspect(array_keys(Container::$components), 'container');
        App::debugger()->inspect($_SERVER, '$_SERVER');
        App::debugger()->inspect($_GET, '$_GET');
        App::debugger()->inspect($_POST, '$_POST');
        if (isset($_SESSION)) {
            App::debugger()->inspect($_SESSION, '$_SESSION');
        }
    }
}