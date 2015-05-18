<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

$config['routing'] = [
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
];

if (APP_ENVIRONMENT != 'production') {
    $config['routing']['routes']['guide'] = ['GET', '/guide', 'martin:guide'];
    $config['routing']['routes']['test'] = ['GET', '/test', 'martin:test'];
}
