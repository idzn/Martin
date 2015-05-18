<?php

namespace application\tests;

use application\custom\Test;

class AdminTest extends Test
{
    public function test_main_page()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('admin_home'));
        $this->assert('Страница имеет код 200', $this->responseStatusCodeIs(200));
        $this->assert('Страница отображается', $this->responseContainsText('hello, admin'));
        //$this->assert('Ссылки создаются правильно', $this->responseContainsText('http://framework.loc/guide"'));
        return $this->assertsResults();
    }
}