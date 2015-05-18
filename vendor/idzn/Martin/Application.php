<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use application\custom\App;
use Martin\exceptions\HttpError;
use Martin\exceptions\RuntimeError;
use Martin\traits\CommonTrait;

class Application
{
    /**
     * @var Container
     */
    public $container;

    use CommonTrait;

    public function __construct($config)
    {
        $this->container = new Container();
        $this->app = new App();
        App::runtime()->config = $config;
    }

    private function routing($routes, $placeholders)
    {
        $routingMap = [];
        foreach ($routes as $routeName => list($methods, $url, $goal)){

            $methods = array_map('strtoupper', array_map('trim', explode(',', $methods)));

            $uriArray = explode('?', $_SERVER['REQUEST_URI']);
            if (count($uriArray) > 2) throw new HttpError(404);
            App::runtime()->uri = $uriArray[0];
            if (isset($uriArray[1])) {
                parse_str($uriArray[1], $_GET);
            }

            foreach ($placeholders as $placeholderKey => $placeholder) {
                $url = str_replace($placeholderKey, '(' . $placeholder . ')', $url);
            }

            if (!preg_match_all(
                '|^('. $url .')$|i',
                App::runtime()->uri,
                $matches,
                PREG_SET_ORDER)
            ) continue;

            $goalArray = explode(':', $goal);
            if (count($goalArray) != 2) throw new RuntimeError('wrong route goal');
            $goalArray = array_map('trim', $goalArray);

            array_shift($matches[0]) && array_shift($matches[0]);

            $path = explode('/', $goalArray[0]);
            $controllerName = $path[count($path)-1];
            if (count($path) > 1) {
                array_pop($path);
                $controllerSubPath = implode('/', $path);
            } else {
                $controllerSubPath = '';
            }

            $routingMap = [
                'routeName' => $routeName,
                'routeMethods' => $methods,
                'controllerSubPath' => $controllerSubPath,
                'controller' => $controllerName,
                'action' => $goalArray[1],
                'params' => $matches[0],
            ];

        }
        return $routingMap;
    }

    private function runController($routingMap)
    {
        $controllerClassName = ucfirst($routingMap['controller']) . 'Controller';
        $controllerSubPath = ($routingMap['controllerSubPath'] == '') ? '' : $routingMap['controllerSubPath'] . '/';
        $namespacedClassName = 'application\\controllers\\' . str_ireplace('/', '\\', $controllerSubPath) . $controllerClassName;
        $controllerFile = CONTROLLERS_PATH . DIRECTORY_SEPARATOR . $controllerSubPath . $controllerClassName . '.php';
        if (!file_exists($controllerFile)) throw new RuntimeError('controller file not found');
        require $controllerFile;
        App::runtime()->routeName = $routingMap['routeName'];
        App::runtime()->controllerSubPath = $routingMap['controllerSubPath'];
        App::runtime()->controllerName = $routingMap['controller'];
        App::runtime()->actionName = $routingMap['action'];
        App::runtime()->actionParams = $routingMap['params'];
        $controllerObject = new $namespacedClassName();
        if (!method_exists($controllerObject, 'action_' . $routingMap['action'])) throw new RuntimeError('action not found');
        echo call_user_func_array([$controllerObject, 'action_' . $routingMap['action']], $routingMap['params']);
    }

    public function run()
    {
        try {
            App::debugger()->start();
            $routingMap = $this->routing(
                App::runtime()->config['routing']['routes'],
                App::runtime()->config['routing']['placeholders']
            );
            if (empty($routingMap)) throw new HttpError(404);
            if (!in_array($_SERVER['REQUEST_METHOD'], $routingMap['routeMethods'])) throw new HttpError(405);
            $this->runController($routingMap);
        }
        catch (HttpError $e) { $this->sendHttpError($e->getCode()); }
        catch (RuntimeError $e) { ob_end_clean(); $this->showRuntimeError($e); exit; }
        finally {
            if (App::runtime()->config['components']['debugger']['enabled']) {
                App::debugger()->stop()->renderInfoPanel();
            }
        }
    }
}