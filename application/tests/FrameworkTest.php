<?php

namespace application\tests;

use application\custom\Test;

class FrameworkTest extends Test
{
    public function test_routing()
    {
        $this->initAsserts();
        $this->sendRequest($this->baseUrl . '/fefnnk6dawf');
        $this->assert('Ошибка 404 работает', $this->responseStatusCodeIs(404));
        return $this->assertsResults();
    }
}