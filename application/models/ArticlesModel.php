<?php

namespace application\models;

use application\custom\App;
use application\custom\Model;

class ArticlesModel extends Model {

    public $tableName = 'articles';

    public function __construct()
    {
        parent::__construct();

    }

    public function getOne($id)
    {
        $data = App::db()
            ->where('id', $id)
            ->get($this->tableName);
        return $data;
    }

    public function getAll($offset = null, $limit = null)
    {
        $data = App::db()
            ->limit($offset, $limit)
            ->get($this->tableName);
        return $data;
    }

    public function getCount()
    {
        return App::db()
            ->count($this->tableName);
    }

}