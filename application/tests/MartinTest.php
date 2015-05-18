<?php

namespace application\tests;

use application\custom\Test;

class MartinTest extends Test
{
    public function test_home_page()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('home'));
        $this->assert('Страница имеет код 200', $this->responseStatusCodeIs(200));
        $this->assert('Страница отображается', $this->responseContainsText('Добро пожаловать!'));
        $this->assert('Ссылки создаются правильно', $this->responseContainsText($this->baseUrl . '/guide"'));
        return $this->assertsResults();
    }

    public function test_singin()
    {
        $this->initAsserts();
        $this->sendRequest($this->urlFor('signin'), 'POST', ['email' => 'martin@martin', 'password' => 'qwerty123', 'csrf_token' => '$2y$10$R6X6iTsUgdLyNQZuyTmaFORwJuLKkppropNxE4nup.oHZk5iB3ubO']);
        $this->assert('Логин работает', $this->responseContainsText('martin@martin (Выйти)'));
        $this->sendRequest($this->urlFor('signin'), 'POST', ['email' => 'martin@martin', 'password' => 'wrong', 'csrf_token' => '$2y$10$R6X6iTsUgdLyNQZuyTmaFORwJuLKkppropNxE4nup.oHZk5iB3ubO']);
        $this->assert('Логин не работает (плохой пароль)', !$this->responseContainsText('martin@martin (Выйти)'));
        $this->assert('Flash работает', $this->responseContainsText('Неверный логин'));
        $this->sendRequest($this->urlFor('signin'), 'POST', ['email' => 'martin@martin', 'password' => 'qwerty123']);
        $this->assert('csrf-защита работает', $this->responseContainsText('wrong csrf-token'));
        $this->sendRequest($this->urlFor('signout'));
        $this->assert('Логаут работает', $this->responseContainsText('Войти'));
        return $this->assertsResults();
    }
}