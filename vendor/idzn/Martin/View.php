<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use application\custom\Register;
use Martin\exceptions\RuntimeError;
use Martin\traits\CommonTrait;
use Martin\traits\UrlMethodsTrait;

class View
{
    use CommonTrait;
    use UrlMethodsTrait;


    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function render($view, $data = [])
    {
        $viewFile = VIEWS_PATH .
            DIRECTORY_SEPARATOR .
            $view .
            '.view.php';
        if (!file_exists($viewFile)) throw new RuntimeError('View file not found');
        ob_start();
        extract($data);
        require $viewFile;
        return ob_get_clean();
    }



} 