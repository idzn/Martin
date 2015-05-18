<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

ini_set('display_errors', false);
error_reporting(0);

return [
    'app' => [
        'name' => 'Martin',
        'protocol' => 'http',
        'host' => 'martin',
    ],
    'routing' => [
        'routes' => [
            'home' => ['GET', '/', 'martin:index'],
            'signin' => ['GET, POST', '/signin', 'main:signin'],
            'signout' => ['GET', '/signout', 'main:signout'],
            'signup' => ['GET, POST', '/signup', 'main:signup'],
            'blog' => ['GET', '/blog', 'blog:index'],
            'blog_show' => ['GET', '/blog/show/{int}', 'blog:show'],
            'admin_home' => ['GET', '/admin', 'admin/main:index'],
        ],
        'placeholders' => [
            '{str}' => '[a-zA-Z]+',
            '{int}' => '[\d]+',
            '{any}' => '[^\/]+',
            '{:-)}' => '[^\/]+',
        ],
    ],
    'components' => [
        'db' => [
            'tablePrefix' => '',
            'persistent' => true,
            /*
             * MySQL
             */
            'type' => 'mysql',
            'dsn' => 'mysql:host=localhost;dbname=martin;',
            'user' => 'root',
            'pass' => 'qwerty123',
        ],
        'user' => [],
        'flash' => [],
        'secure' => [
            'csrf_token' => 'f4PoaJd7a3mK3HB2mldIs', // must be not empty!
        ],
        'paginator' => [],
        'debugger' => [
            'enabled' => true,
            'visibled' => true,
        ],
        'assets' => [
            'pathMode' => 0777,
        ],
    ]
];



 