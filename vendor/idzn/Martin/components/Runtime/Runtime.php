<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin\components\Runtime;

class Runtime
{
    public $config;
    public $components;

    public $uri;

    public $routeName;
    public $controllerSubPath;
    public $controllerName;
    public $actionName;
    public $actionParams;

    public $pageTitle;
    public $pageDescription;
    public $pageAuthor;
    public $pageKeywords;
}
