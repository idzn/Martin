<?php
/**
 * @var application\custom\View $this
 */
?>
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <div style="text-align: center">
        <img src="/images/martin-logo.png" alt=""/>
        <h1>Hello, world!</h1>
    </div>
    <p style="text-align: center">
        <br/>
        <a class="btn btn-lg btn-primary" href="<?=$this->urlFor('guide')?>" role="button">Руководство разработчика &raquo;</a>
        <a class="btn btn-lg btn-primary" href="<?=$this->urlFor('blog')?>" role="button">Демо-блог &raquo;</a>

    </p>
</div>