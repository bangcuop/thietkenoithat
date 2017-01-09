<?php
$baseImg = Yii::$app->params['image']['baseUrl'];
$noImg = \yii\helpers\Url::base(true) . '/images/no-image-box.png';
?>
<?php if (!empty($bannerHeart)) { ?>
    <div class="content">
        <div class="container">
            <div class="slider">
                <ul class="rslides" id="slider1">
                    <?php foreach ($bannerHeart as $bn) { ?>
                        <li><img src="<?= $bn->images[0] ?>" alt=""></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>
<!---->
<?php if (!empty($bannerCenter)) { ?>
    <div class="bottom_content">
        <div class="container">
            <div class="sofas">
                <?php foreach ($bannerCenter as $bnc) { ?>
                    <div class="col-md-6 sofa-grid sofs">
                        <img src="<?= $bnc->images[0] ?>" alt=""/>
                        <h3><?= $bnc->name ?></h3>
                        <h4><a href="<?= $bnc->link ?>"><?= $bnc->description ?></a></h4>
                    </div>
                <?php } ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php } ?>
<!---->
<div class="new">
    <div class="container">
        <h3>Sản phẩm đặc biệt của Minh Đoàn</h3>
        <div class="new-products">
            <?php foreach ($spe->data as $item){ ?>
            <div class="new-items">
                <div class="item1">
                    <a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><img src="<?= isset($images[$item->id]) ? $baseImg . $images[$item->id]->imageId : $noImg ?>" alt="<?= $item->name ?>"/></a>
                    <div class="item-info">
                        <h4><a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><?= $item->name ?></a></h4>
                        <span><?= ($item->sellPrice != null && $item->sellPrice > 0) ? \common\util\TextUtils::numberFormat($item->sellPrice) . ' VND' : 'Giá: liên hệ' ?> </span>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="top-sellers">
    <div class="container">
        <h3>Sản phẩm bán chạy</h3>
        <div class="seller-grids">
            <?php foreach ($best->data as $item){ ?>
                <div class="col-md-3 seller-grid">
                    <a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><img src="<?= isset($images[$item->id]) ? $baseImg . $images[$item->id]->imageId : $noImg ?>" alt="<?= $item->name ?>"/></a>
                    <h4><a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><?= $item->name ?></a></h4>
                    <span>ID: <?= $item->id ?></span>
                    <p><?= ($item->sellPrice != null && $item->sellPrice > 0) ? \common\util\TextUtils::numberFormat($item->sellPrice) . ' VND' : 'Giá: liên hệ' ?> </p>
                </div>
            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="recommendation">
    <div class="container">
        <div class="recmnd-head">
            <h3>Gợi ý mua sắm</h3>
        </div>
        <div class="bikes-grids">
            <ul id="flexiselDemo1">

                <?php foreach ($sug->data as $item){ ?>
                    <li>
                        <a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><img src="<?= isset($images[$item->id]) ? $baseImg . $images[$item->id]->imageId : $noImg ?>" alt="<?= $item->name ?>"/></a>
                        <h4><a href="<?= \common\util\UrlUtils::item($item->id,$item->name) ?>"><?= $item->name ?></a></h4>
                        <p>ID: <?= $item->id ?></p>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>