<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin\exceptions;

class HttpError extends \Exception
{
    public function __construct($httpStatusCode)
    {
        parent::__construct('', $httpStatusCode);
    }
}