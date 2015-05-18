<?php

namespace application\controllers\admin;

use application\custom\AdminController;
use application\custom\App;

class MainController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'martin';
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function action_index()
    {
        App::runtime()->pageTitle = 'Admin area';
        return $this->render('admin/main/index');
    }
}