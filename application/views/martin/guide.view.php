<?php
/**
 * @var application\custom\View $this
 */
?>
<script>
    $(document).ready(function(){
        $('a[name]').css({'position':'absolute','margin-top':'-60px'});
        $('body').scrollspy({ target: '.guide-navbar' })
    });
</script>
<div class="col-md-3 guide-sidebar">
    <div class="affix guide-navbar">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="#a-1">Системные требования</a></li>
            <li><a href="#a-2">Установка и первый запуск</a></li>
            <li><a href="#a-3">Файловая структура проекта</a></li>
        </ul>
    </div>
</div>
<div class="col-md-9 guide-main">
    <?php
    $md = file_get_contents(ROOT_PATH . '/DOC.md');
    $html = Michelf\Markdown::defaultTransform($md);
    echo $html;
    ?>
</div>

