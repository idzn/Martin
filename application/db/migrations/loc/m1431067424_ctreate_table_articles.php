<?php

namespace application\db\migrations\local;

use application\custom\App;
use application\custom\Migration;

class m1431067424_ctreate_table_articles extends Migration
{
    public function __construct()
    {
        parent::__construct();

    }

    public function up()
    {
        if ($this->dbType == 'sqlite') {
            App::db()->query(
                "CREATE TABLE IF NOT EXISTS articles (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    title TEXT NOT NULL,
                    content TEXT NOT NULL,
                    created_at INTEGER,
                    updated_at INTEGER
                );"
            );
        } elseif ($this->dbType == 'mysql') {
            App::db()->query(
                "CREATE TABLE IF NOT EXISTS articles (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    title varchar(255) NOT NULL,
                    content TEXT NOT NULL,
                    created_at int(11),
                    updated_at int(11),
                    PRIMARY KEY (id)
                );"
            );
        }
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS articles;";
        App::db()->query($sql);
    }
} 