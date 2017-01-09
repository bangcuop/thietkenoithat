<?php
$baseImg = Yii::$app->params['image']['baseUrl'];
$noImg = \yii\helpers\Url::base(true) . '/images/no-image-box.png';
?>
<div class="product-model">
    <div class="container">
        <?= \frontend\views\widgets\BreadWidget::widget(['id' => Yii::$app->request->get('id')]) ?>
        <h2>Sản phẩm</h2>
        <div class="col-md-9 product-model-sec">
            <?php foreach ($items->data as $item) { ?>


                <a href="<?= \common\util\UrlUtils::item($item->id, $item->name) ?>"><div class="product-grid love-grid">
                        <div class="more-product"><span> </span></div>
                        <div class="product-img b-link-stripe b-animate-go  thickbox">
                            <span class="img-box"><img src="<?= isset($images[$item->id]) ? $baseImg . $images[$item->id]->imageId : $noImg ?>" class="img-responsive" alt=""/></span>
                            <div class="b-wrapper">
                                <h4 class="b-animate b-from-left  b-delay03">
                                    <button class="btns"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Xem</button>
                                </h4>
                            </div>
                        </div></a>
                <div class="product-info simpleCart_shelfItem">
                    <div class="product-info-cust prt_name">
                        <h4><?= $item->name ?></h4>
                        <p>ID: <?= $item->id ?></p>
                        <span class="item_price"><?= ($item->sellPrice != null && $item->sellPrice > 0) ? \common\util\TextUtils::numberFormat($item->sellPrice) . ' VND' : 'Liên hệ' ?> </span>
                        <br />
                        <a class="btn item_add items" href="<?= \common\util\UrlUtils::item($item->id, $item->name) ?>">Chi tiết<a>
                                </div>
                                <div class="clearfix"> </div>
                                </div>
                                </div>
                            <?php } ?>
                            <?=
                            \frontend\views\widgets\PagingWidget::widget([
                                'page' => $items->page,
                                'size' => $items->pageSize,
                                'count' => $items->pageCount,
                            ])
                            ?>
                            </div>
                            <div class="rsidebar span_1_of_left">
                                <section class="sky-form">
                                    <div class="product_right">
                                        <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Danh mục</h4>
<?php foreach ($sub as $sub1) { ?>
                                            <div class="cat-tab">
                                                <ul class="place" for="<?= $sub1->id ?>">
                                                    <li class="sort"><?= $sub1->name ?></li>
                                                    <li class="by"><img src="<?= \yii\helpers\Url::base() ?>/images/do.png" alt=""></li>
                                                    <div class="clearfix"></div>
                                                </ul>
                                                    <?php if (isset($sub2[$sub1->id])) { ?>
                                                    <div style="<?= Yii::$app->request->get('id', 0) != $sub1->id ? 'display: none;' : '' ?>" class="single-bottom">
                                                        <?php foreach ($sub2[$sub1->id] as $sub22) { ?>
                                                            <a href="<?= \common\util\UrlUtils::category($sub22->id, $sub22->name) ?>"><p><?= $sub22->name ?></p></a>
                                                    <?php } ?>
                                                    </div>
                                            <?php } ?>
                                            </div>
<?php } ?>
                                    </div>
                                </section>
                                <section  class="sky-form">
                                    <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Màu sắc</h4>
                                    <div class="row row1 scroll-pane">
<?php foreach ($items->other['colors'] as $color) { ?>
                                            <div class="col col-4">
                                                <label class="checkbox"><input type="checkbox" name="colors" value="<?= empty($color['color']) ? 'Khác' : $color['color'] ?>"><i></i><?= empty($color['color']) ? 'Khác' : $color['color'] ?> (<?= $color['count'] ?>)</label>
                                            </div>
<?php } ?>
                                    </div>
                                </section>
                                <section  class="sky-form">
                                    <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Kích cỡ</h4>
                                    <div class="row row1 scroll-pane">
<?php foreach ($items->other['sizes'] as $size) { ?>
                                            <div class="col col-4">
                                                <label class="checkbox"><input type="checkbox" name="sizes" value="<?= empty($size['size']) ? 'Khác' : $size['size'] ?>"><i></i><?= empty($size['size']) ? 'Khác' : $size['size'] ?> (<?= $size['count'] ?>)</label>
                                            </div>
<?php } ?>
                                    </div>
                                </section>
                                <section  class="sky-form">
                                    <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Dòng sản phẩm</h4>
                                    <div class="row row1 scroll-pane">
                                        <div class="col col-4">
                                            <label class="checkbox"><input type="checkbox" name="prototype" value="<?= \common\models\enu\ItemType::CLASSIC ?>"><i></i>Cổ điển (<?= isset($items->other['prototype'][\common\models\enu\ItemType::CLASSIC]) ? $items->other['prototype'][\common\models\enu\ItemType::CLASSIC] : 0 ?>)</label>
                                            <label class="checkbox"><input type="checkbox" name="prototype" value="<?= \common\models\enu\ItemType::MODERN ?>"><i></i>Hiện đại (<?= isset($items->other['prototype'][\common\models\enu\ItemType::MODERN]) ? $items->other['prototype'][\common\models\enu\ItemType::MODERN] : 0 ?>)</label>
                                            <label class="checkbox"><input type="checkbox" name="prototype" value="<?= \common\models\enu\ItemType::CRAFTS ?>"><i></i>Thủ công (<?= isset($items->other['prototype'][\common\models\enu\ItemType::CRAFTS]) ? $items->other['prototype'][\common\models\enu\ItemType::CRAFTS] : 0 ?>)</label>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            </div>
                            </div>