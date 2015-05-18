<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use application\custom\Register;
use \Martin\exceptions\RuntimeError;
use Martin\traits\CommonTrait;
use Martin\traits\UrlMethodsTrait;

use \application\custom\View;

class Controller
{
    use CommonTrait;
    use UrlMethodsTrait;



    public $layout = 'main';

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function text($text, $status = '200 OK'){
        header("HTTP/1.x $status");
        return $text;
    }

    public function json($json, $status = '200 OK', $jsonParam = JSON_PRETTY_PRINT)
    {
        $this->text(json_encode($json, $jsonParam), $status);
    }

    public function render($view, $data = [])
    {
        ob_start();
        echo (new View())->render($view, $data);
        $renderedView = ob_get_clean();

        $layoutFile = LAYOUTS_PATH .
            DIRECTORY_SEPARATOR .
            $this->layout .
            '.layout.php';
        if (!file_exists($layoutFile)) throw new RuntimeError('Layout file not found');

        ob_start();
        require $layoutFile;
        $layout = ob_get_clean();
        return $layout;
    }

    public function renderPartial($view, $data = [])
    {
        ob_start();
        echo (new View())->render($view, $data);
        return ob_get_clean();
    }

    public function redirectTo($url, $status = 302)
    {
        header('Location: ' . $url, null, $status);
        exit;
    }

    public function redirectBack() {
        $this->redirectTo($_SERVER['HTTP_REFERER']);
    }

    function isAjax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
    }

} 