<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

ini_set('display_errors', true);
error_reporting(E_ALL & ~E_STRICT);

return [
    'routing' => [
        'routes' => [
            'guide' => ['GET', '/guide', 'martin:guide'],
            'test' =>['GET', '/test', 'martin:test'],
        ],
    ],
    'components' => [
        'db' => [
            /*
             * SQLite3
             */
            'type' => 'sqlite',
            'dsn' => 'sqlite:' . DB_PATH . '/db.db',
            'user' => null,
            'pass' => null,
        ],
        'debugger' => [
            'enabled' => true,
            'visibled' => true,
        ],
    ]
];


