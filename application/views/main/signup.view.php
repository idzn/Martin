<?php
/**
 * @var application\custom\View $this
 */
use application\custom\App;

?>
<div class="container" style="width: 300px">

<?php App::html()->beginForm('signup'); ?>

    <h2>Регистрация</h2>

    <?php echo App::html()->inputEmail('email', [
        'class' => 'form-control',
        'placeholder' => 'Email',
        'value' => (isset($_POST['email'])) ? $_POST['email'] : '',
    ]); ?>

    <?php echo App::html()->inputText('first_name', [
        'class' => 'form-control',
        'placeholder' => 'Имя',
        'value' => (isset($_POST['first_name'])) ? $_POST['first_name'] : '',
    ]); ?>

    <?php echo App::html()->inputText('last_name', [
        'class' => 'form-control',
        'placeholder' => 'Фамилия',
        'value' => (isset($_POST['last_name'])) ? $_POST['last_name'] : '',
    ]); ?>

    <?php echo App::html()->inputPassword('password', [
        'class' => 'form-control',
        'placeholder' => 'Пароль',
        'value' => (isset($_POST['password'])) ? $_POST['password'] : '',
    ]); ?>

    <?php echo App::html()->inputPassword('password_confirm', [
        'class' => 'form-control error',
        'placeholder' => 'Повтор пароля',
        //'value' => (isset($_POST['password_confirm'])) ? $_POST['password_confirm'] : '',
    ]); ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>

<?php App::html()->endForm(); ?>

</div>
