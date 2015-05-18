<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace application\custom;

class Test extends \Martin\Test
{


    public $baseUrl;

    public function __construct()
    {
        parent::__construct();
        $this->baseUrl = App::runtime()->config['app']['protocol'] . '://' . App::runtime()->config['app']['host'];
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}