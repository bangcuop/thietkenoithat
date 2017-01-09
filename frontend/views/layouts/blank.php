<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use \backend\assets\BackendAsset;
BackendAsset::register($this);
$this->registerJsFile('@web/js/qtools.js', ['depends' => ['\backend\assets\BackendAsset'], 'position' => \yii\web\View::POS_END,], 'qtools');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?= \common\widgets\StaticWidget::widget() ?>
</body>
</html>
<?php $this->endPage() ?>
