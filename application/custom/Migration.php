<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace application\custom;

class Migration extends \Martin\Migration
{

    public $dbType;

    public function __construct()
    {
        parent::__construct();
        $this->dbType = App::runtime()->config['components']['db']['type'];

    }

    public function __destruct()
    {
        parent::__destruct();
    }
}