<?php
$from = ($page * $size) - ($size - 1);
$to = $page * $size;
if ($to > $count) {
    $to = $count;
}
?>
<?php if ($size > 0) {?>
<div class="clearfix"></div>
<div class="text-center">
    <nav>
    <ul class="pagination">
        <li>
            <?php $prev = $page <= 1 ? 1 : $page - 1; ?>
            <a href="<?= \yii\helpers\Url::current(['page' => $prev]) ?>" aria-label="Previous">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <?php for ($i = $page - 5; $i <= $page + 5; $i++) { ?>
            <?php if ($i > 0 && $i <= $count) { ?>
                <li class="<?= $page == $i ? 'active' : '' ?>"><a
                        href="<?= \yii\helpers\Url::current(['page' => $i]) ?>"><?= $i ?></a></li>
            <?php } ?>
        <?php } ?>
        <?php $next = $page >= $count ? $count : $page + 1; ?>
        <li>
            <a href="<?= \yii\helpers\Url::current(['page' => $next]) ?>" aria-label="Next"><span aria-hidden="true">»</span></a>
        </li>
    </ul>
    </nav>
</div>
<?php } ?>