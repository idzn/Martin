<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */

namespace Martin;

use Martin\traits\CommonTrait;
use Martin\traits\UrlMethodsTrait;

class Test {

    use CommonTrait;
    use UrlMethodsTrait;

    private $asserts = [];
    private $lastResponse;
    private $lastRequestInfo;

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function assert($name, $condition)
    {
        $this->asserts[$name] = ($condition) ? 1 : 0;
    }

    public function assertsResults()
    {
        return $this->asserts;
    }

    public function initAsserts()
    {
        $this->asserts = [];
    }

    private function request($url, $method, $data = [], $headers = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, TMP_PATH . '/testing_cookie.txt');
        if (count($headers)) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }

        if (count($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        $response = curl_exec($ch);
        $this->lastRequestInfo = curl_getinfo($ch);
        curl_close($ch);

        return $response;
    }

    public function sendRequest($url, $method = 'GET', $data = [], $headers = [])
    {
        $this->lastResponse = $this->request($url, $method, $data, $headers);
    }

    public function responseContainsText($text)
    {
        return (strpos($this->lastResponse, $text) !== false) ? true : false;
    }

    public function responseStatusCodeIs($statusCode)
    {

        return ($this->lastRequestInfo['http_code'] == $statusCode) ? true : false;
    }

    public function getLastResponse()
    {
        return $this->lastResponse;
    }


} 