<?php

use yii\helpers\BaseUrl;
?>
<div class="news-list container">
    <ul>
        <?php
        if (!empty($news->data)) {
            foreach ($news->data as $new) {
                ?>
                <li>
                    <div class="thumb">
                        <a href="<?= common\util\UrlUtils::newDetail($new->id, $new->name) ?>"><img src="<?= empty($new->images) ? BaseUrl::base() . '/images/no_avatar.png' : $new->images[0] ?>" alt="" title=""/></a>
                    </div>
                    <div class="info">
                        <a href="<?= common\util\UrlUtils::newDetail($new->id, $new->name) ?>" class="name"><?= $new->name ?></a>
                        <div class="desc">
                            <?= $new->description ?>
                        </div>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
     <?=
    \frontend\views\widgets\PagingWidget::widget([
        'page' => $news->page,
        'size' => $news->pageSize,
        'count' => $news->pageCount,
    ])
    ?>