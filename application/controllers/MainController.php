<?php

namespace application\controllers;

use application\custom\App;
use application\custom\Controller;
use Martin\components\Flash\Flash;
use Martin\components\Validator\Validator;
use Martin\exceptions\RuntimeError;

class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'martin';
    }

    public function action_index()
    {
        if (!App::user()->isAuthorized()) $this->redirectTo($this->urlFor('login'));
        return $this->text('Hello, world!');
    }

    public function action_signin()
    {
        App::runtime()->pageTitle = 'Вход';
        if (count($_POST)) {
            if (!App::secure()->validCsrfToken()) {
                throw new RuntimeError('wrong csrf-token');
            }
            $user = App::db()
                ->where('email', $_POST['email'])
                ->get('users');
            if (count($user) && password_verify($_POST['password'], $user['password'])) {
                App::user()->setArray($user);
                $this->redirectTo($this->urlFor('home'));
            } else {
                App::flash()->set('error', 'Неверный логин или пароль. Попробуйте ещё раз', Flash::TYPE_ERROR);
            }
        }

        return $this->render('main/signin');
    }

    public function action_signout()
    {
        App::user()->forget();
        $this->redirectTo($this->urlFor('home'));
    }

    public function action_signup()
    {
        App::runtime()->pageTitle = 'Регистрация';

        if (count($_POST)) {
            if (!App::secure()->validCsrfToken()) {
                throw new RuntimeError('wrong csrf-token');
            }

            if (App::validator()
                ->validate($_POST)
                ->addFor('email', 'E-mail')
                ->ruleRequired('Необходимо указать E-mail')
                ->ruleEmail('Недействительный адрес E-mail')
                ->addFor('first_name', 'Имя')
                ->ruleRequired('Необходимо указать имя')
                ->addFor('last_name', 'Фамилия')
                ->ruleRequired('Необходимо указать фамилию')
                ->addFor('password', 'Пароль')
                ->ruleRequired('Необходимо указать пароль')
                ->ruleMinLength(8, 'Минимальная длина пароля - 8 символов')
                ->addFor('password_confirm', 'Подтверждение пароля')
                ->ruleRequired('Необходимо указать пароль дважды')
                ->ruleEqual('password', 'Пароли не совподают')
                ->run()) {
                App::flash()->set('success', 'Вы успешно зарегистрировались. Введите email и пароль чтобы войти.', Flash::TYPE_SUCCESS);
                $this->redirectTo($this->urlFor('signin'));
            }

        }
        return $this->render('main/signup');
    }

} 