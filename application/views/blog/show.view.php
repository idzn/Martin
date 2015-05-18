<?php
/**
 * @var application\custom\View $this
 */
?>
<ol class="breadcrumb">
    <li><a href="<?=$this->urlFor('home')?>">Martin</a></li>
    <li><a href="<?=$this->urlFor('blog')?>">Блог</a></li>
    <li class="active"><?=$data['title']?></li>
</ol>
<article>
    <h1><?=$data['title']?></h1>
    <p><?=date('Y-m-d H:i:s', $data['created_at'])?></p>
    <?=$data['content']?>
</article>
<p><a class="btn btn-default" href="<?=$this->getReferrerUrl()?>">← К списку статей</a></p>
