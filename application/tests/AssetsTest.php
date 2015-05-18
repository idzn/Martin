<?php

namespace application\tests;

use application\custom\Test;

class AssetsTest extends Test
{
    public function test_home_page()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('home'));
        $this->assert('jQuery грузится', $this->responseContainsText('jquery'));
        return $this->assertsResults();
    }
}