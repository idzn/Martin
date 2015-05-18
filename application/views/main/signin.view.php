<?php
/**
 * @var application\custom\View $this
 */
use application\custom\App;

?>
<div class="container" style="width: 300px">
    <form class="form-signin" role="form" method="post" action="<?=$this->urlFor('signin')?>">
        <?=App::secure()->csrfProtectHere()?>
        <h2 class="form-signin-heading">Вход</h2>
        <input type="email" class="form-control" name="email" placeholder="Email" required="" autofocus="">
        <br>
        <input type="password" class="form-control" name="password" placeholder="Пароль" required="">
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Запомнить меня
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        <br><p><a href="<?=$this->urlFor('signup')?>">Зарегистрироватья</a></p>
    </form>
</div>