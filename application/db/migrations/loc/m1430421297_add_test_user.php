<?php

namespace application\db\migrations\local;

use application\custom\App;
use application\custom\Migration;

class m1430421297_add_test_user extends Migration
{
    public function __construct()
    {
        parent::__construct();

    }

    public function up()
    {
        App::db()->insert('users', [
            'id' => 1,
            'email' => 'martin@martin',
            'password' => '$2y$10$rYmci/VYmaylnC9uNZpi9eQfrkW6NVd6.LxraCEZFPCs27GSEoni2',
        ]);
    }

    public function down()
    {
        App::db()->query("DELETE FROM users WHERE email = 'martin@martin'");
    }
} 