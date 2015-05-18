<?php
/**
 * @var application\custom\View $this
 */
use application\custom\App;

?>
<ol class="breadcrumb">
    <li><a href="<?=$this->urlFor('home')?>">Martin</a></li>
    <li class="active">Блог</li>
</ol>
<?php if (empty($data)) { ?>
    <p><em>No articles.</em></p>
<?php } else { ?>
    <?php foreach ($data as $article) { ?>
        <article>
            <h2><?=$article['title']?></h2>
            <p><?=date('Y-m-d H:i:s', $article['created_at'])?></p>
            <?=App::text()->wordsLimit(App::text()->stripTags($article['content']), 50)?>
            <br/>
            <a class="btn btn-default" href="<?=$this->urlFor('blog_show', [$article['id']])?>" role="button">Читать &raquo;</a>
        </article>
        <hr/>
    <?php } ?>
<?php } ?>
<?=App::paginator()->renderPagination()?>
