<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

return [

];

if (APP_ENVIRONMENT != 'production') {
    $config['routing']['routes']['guide'] = ['GET', '/guide', 'martin:guide'];
    $config['routing']['routes']['test'] = ['GET', '/test', 'martin:test'];
}
