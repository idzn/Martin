<?php
/**
 * @link https://github.com/idzn/Martin
 * @copyright Copyright (c) 2015, Sergei Tolokonnikov
 * @license https://github.com/idzn/Martin/blob/master/LICENSE
 */
?>
<?php
/**
 * @var application\custom\Controller $this
 */
?>
<?php use application\custom\App; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="<?=App::runtime()->pageAuthor?>">
    <meta name="keywords" content="<?=App::runtime()->pageKeywords?>">
    <meta name="description" content="<?=App::runtime()->pageDescription?>">
    <?php
    if (APP_ENVIRONMENT == 'local') {
        App::assets()->linkScript(WEB_PATH . '/js/jquery/jquery.js');
    } else {
        App::assets()->linkScript(WEB_PATH . '/js/jquery/jquery.min.js');
    }
    ?>
    <?php App::assets()->linkScript(WEB_PATH . '/bootstrap/js/bootstrap.min.js'); ?>
    <link href="/images/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <?php App::assets()->linkStylesheet(WEB_PATH . '/bootstrap/css/bootstrap.min.css'); ?>
    <?php App::assets()->linkStylesheet(WEB_PATH . '/css/martin.css'); ?>
    <?php App::assets()->linkStylesheet(WEB_PATH . '/css/blog.css'); ?>
    <title><?=App::runtime()->pageTitle?> | <?=App::runtime()->config['app']['name']?></title>
</head>
<body>
<?=$this->renderPartial('martin/_topmenu')?>
<div class="container">
    <?php App::flash()->renderMessagesHere(); ?>
    <?=$renderedView?>
</div> <!-- /container -->

</body>
</html>