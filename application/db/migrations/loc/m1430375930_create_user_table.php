<?php

namespace application\db\migrations\local;

use application\custom\App;
use application\custom\Migration;

class m1430375930_create_user_table extends Migration
{
    public function up()
    {
        if ($this->dbType == 'sqlite') {
            App::db()->query(
                "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    email TEXT NOT NULL,
                    password TEXT NOT NULL
                );"
            );
        } elseif ($this->dbType == 'mysql') {
            App::db()->query(
                "CREATE TABLE IF NOT EXISTS users (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    email varchar(255) NOT NULL,
                    password varchar(60) NOT NULL,
                    PRIMARY KEY (id),
                    UNIQUE KEY email_UNIQUE (email)
                );"
            );
        }
        /*
        App::db()
            ->ifNotExists()
            ->createTable('users', [
                'id' => [
                    'type' => 'integer',
                    'size' => 11,
                    'null' => 'false',
                    'ai' => true,
                    'pk' => true,
                ],
                'email' => [
                    'type' => 'varchar',
                    'size' => 255,
                    'null' => 'false',
                ],
                'password' => [
                    'type' => 'varchar',
                    'size' => 60,
                    'null' => 'false',
                  ],
            ]);
        */
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS users;";
        App::db()->query($sql);
        /*
        App::db()
            ->dropTable('users');
        */
    }
} 