<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin\traits;

use application\custom\App;

trait UrlMethodsTrait
{

    public function urlFor($routeName, $params = [])
    {
        foreach (App::runtime()->config['routing']['routes'] as $routeKey => $route) {

            if ($routeKey != $routeName) continue;
            foreach (App::runtime()->config['routing']['placeholders'] as $placeholder => $pattern) {
                $route[1] = str_ireplace($placeholder, '{}', $route[1]);
            }
            preg_match_all('|{}|', $route[1], $matches);
            if (count($params) != count($matches[0])) return;
            $matches[0] = array_map(function($val){ return '|' . $val . '|'; }, $matches[0]);
            return App::runtime()->config['app']['protocol'] . '://' . App::runtime()->config['app']['host'] . preg_replace($matches[0], $params, $route[1], 1);
        }
        return;
    }

    public function getReferrerUrl()
    {
        return (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
    }

} 