<?php
/**
 * @var application\custom\View $this
 */
use application\custom\App;

?>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$this->urlFor('home')?>"><?=App::runtime()->config['app']['name']?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li<?=(App::runtime()->routeName == 'home') ? ' class="active"' : ''?>><a href="<?=$this->urlFor('home')?>">Home</a></li>
                <li<?=(App::runtime()->routeName == 'guide') ? ' class="active"' : ''?>><a href="<?=$this->urlFor('guide')?>">Guide</a></li>
                <li<?=(in_array(App::runtime()->routeName, ['blog',''])) ? ' class="active"' : ''?>><a href="<?=$this->urlFor('blog')?>">Demo</a></li>
                <li<?=(App::runtime()->routeName == 'admin_home') ? ' class="active"' : ''?>><a href="<?=$this->urlFor('admin_home')?>">Admin</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (App::user()->isAuthorized()) { ?>
                    <li><a href="<?=$this->urlFor('signout')?>"><?=App::user()->get('email')?> (Выйти)</a></li>
                <?php } else { ?>
                    <li<?=(App::runtime()->routeName == 'signin') ? ' class="active"' : ''?>>
                        <a href="<?=$this->urlFor('signin')?>">Войти</a>
                    </li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
