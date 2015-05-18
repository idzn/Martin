<?php

namespace application\tests;

use application\custom\Test;

class ValidatorTest extends Test
{
    public function test_validation()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('signup'), 'POST', [
            'email' => '',
            'csrf_token' => '$2y$10$R6X6iTsUgdLyNQZuyTmaFORwJuLKkppropNxE4nup.oHZk5iB3ubO',
        ]);
        $this->assert('Валидация работает 1', $this->responseContainsText('Необходимо указать E-mail'));
        $this->assert('Валидация работает 2', $this->responseContainsText('Недействительный адрес E-mail'));
        return $this->assertsResults();
    }
}