<?php

namespace application\tests;

use application\custom\Test;

class BlogTest extends Test
{
    public function test_index_page()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('blog') . '?page=2');
        $this->assert('Страница имеет код 200', $this->responseStatusCodeIs(200));
        $this->assert('Страница показывается правильно', $this->responseContainsText('<h2>Статья 4</h2>'));
        $this->sendRequest($this->urlFor('blog_show', ['5']));
        $this->assert('Статья показывается правильно', $this->responseContainsText('<h1>Статья 5</h1>'));
        return $this->assertsResults();
    }
}