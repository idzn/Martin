<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace application\controllers;

use application\custom\App;
use application\custom\Controller;

class MartinController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'martin';
    }

    public function action_index()
    {
        App::runtime()->pageTitle = 'Добро пожаловать!';
        return $this->render('martin/index');
    }

    public function action_guide()
    {
        App::runtime()->pageTitle = 'Руководство разработчика';
        return $this->render('martin/guide');
    }

    public function action_test()
    {
        return $this->text('test');
    }
}