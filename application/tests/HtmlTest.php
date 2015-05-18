<?php

namespace application\tests;

use application\custom\Test;

class HtmlTest extends Test
{
    public function test_home_page()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('signup'));
        $this->assert('Генератор форм работает 1', $this->responseContainsText('<form'));
        $this->assert('Генератор форм работает 2', $this->responseContainsText('<input'));
        return $this->assertsResults();
    }
}