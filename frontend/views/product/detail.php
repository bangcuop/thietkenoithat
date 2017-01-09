<?php
$baseImg = Yii::$app->params['image']['baseUrl'];
?>
<div class="single-sec">
    <div class="container">

        <?= \frontend\views\widgets\BreadWidget::widget(['id' => $item->categoryId]) ?>

        <div class="col-md-12 det">
            <div class="single_left">
                <div class="grid images_3_of_2">
                    <ul id="etalage">
                        <?php if (!empty($images)) { ?>
                            <?php foreach ($images as $image) { ?>
                                <li>
                                    <a href="#">
                                        <img class="etalage_thumb_image" src="<?= $baseImg . $image->imageId ?>" class="img-responsive" />
                                        <img class="etalage_source_image" src="<?= $baseImg . $image->imageId ?>" class="img-responsive" title="" />
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } else { ?> 
                            <li>
                                <a href="#">
                                    <img class="etalage_thumb_image" src="<?= yii\helpers\BaseUrl::base() . '/images/no_avatar.png' ?>" class="img-responsive" />
                                    <img class="etalage_source_image" src="<?= yii\helpers\BaseUrl::base() . '/images/no_avatar.png' ?>" class="img-responsive" title="" />
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="single-right">
                <h3><?= $item->name ?></h3>
                <div class="id"><h4>ID: <?= $item->id ?></h4></div>
                <form action="" class="sky-form">
                    <fieldset>
                        <section>
                            <div class="rating">
                                <input type="radio" name="stars-rating" id="stars-rating-5">
                                <label for="stars-rating-5"><i class="icon-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-4">
                                <label for="stars-rating-4"><i class="icon-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-3">
                                <label for="stars-rating-3"><i class="icon-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-2">
                                <label for="stars-rating-2"><i class="icon-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-1">
                                <label for="stars-rating-1"><i class="icon-star"></i></label>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                    </fieldset>
                </form>
                <div class="cost">
                    <div class="prdt-cost">
                        <ul>
                            <li>Giá bán:</li>
                            <li class="active"><?= ($item->sellPrice != null && $item->sellPrice > 0) ? \common\util\TextUtils::numberFormat($item->sellPrice) . ' VND' : 'Liên hệ' ?> </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="item-list">
                    <ul>
                        <li>Kích thước: <?= empty($item->size) ? 'Khác' : $item->size ?></li>
                        <li>Màu sắc: <?= empty($item->color) ? 'Khác' : $item->color ?></li>
                        <li>Dòng sản phẩm:
                        <?php switch ($item->prototype){
                            case \common\models\enu\ItemType::CLASSIC:
                                echo 'Cổ điển';
                                break;
                            case \common\models\enu\ItemType::MODERN:
                                echo 'Hiện đại';
                                break;
                            case \common\models\enu\ItemType::CRAFTS:
                                echo 'Thủ công';
                                break;
                            default:
                                echo 'Khác';
                        } ?>
                        </li>
                    </ul>
                </div>
                <div class="single-bottom1">
                    <h6>Mô tả</h6>
                    <p class="prod-desc"><?= $item->description ?></p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="sofaset-info">
                <h4>Giới thiệu chi tiết sản phẩm <?= $item->name ?></h4>
                <?= $item->details ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>