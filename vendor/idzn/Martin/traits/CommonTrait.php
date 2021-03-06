<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin\traits;

use Martin\exceptions\RuntimeError;

trait CommonTrait
{
    private function sendHttpError($code)
    {
        switch ($code) {
            case 404:
                header("HTTP/1.x 404 Not Found");
                die('Page not found');
            case 405:
                header("HTTP/1.x 405 Method Not Allowed");
                die('Method Not Allowed');
        }
    }

    private function showRuntimeError(RuntimeError $e)
    {
        @ob_end_clean();
        echo "ERROR: " . $e->getMessage();
        exit;
    }

}

function dump($var, $exit = false)
{
    echo '<pre>';
    echo print_r($var);
    echo '</pre>';
    if ($exit) exit;
}