<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

ini_set('display_errors', true);
error_reporting(E_ALL & ~E_STRICT);

$config = [
    'app' => [
        'name' => 'Martin',
        'protocol' => 'http',
        'host' => 'martin',
    ],
    'components' => [
        'db' => [
            'tablePrefix' => '',
            'persistent' => true,
            /*
             * SQLite3
             */
            'type' => 'sqlite',
            'dsn' => 'sqlite:' . DB_PATH . '/db.db',
            'user' => null,
            'pass' => null,
            /*
             * MySQL
             */
            /*
            'type' => 'mysql',
            'dsn' => 'mysql:host=localhost;dbname=martin;',
            'user' => 'root',
            'pass' => 'qwerty123',
            */
        ],
        'user' => [],
        'flash' => [],
        'secure' => [
            'csrf_token' => 'f4PoaJd7a3mK3HB2mldIs', // must be not empty!
        ],
        'pager' => [],
        'debugger' => [
            'enabled' => true,
            'visibled' => true,
        ],
        'assets' => [
            'pathMode' => 0777,
        ],
    ]
];


