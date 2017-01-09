<?php

use backend\assets\AppAsset;
use backend\widgets\Alert;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <?= Html::csrfMetaTags() ?>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages: ["corechart"]});
        </script>
        <title data-rel="title" ><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="navbar navbar-default" role="navigation" data-rel="navigation" ></div>
        <div class="tree-view">
            <div class="container">
                <div class="admin-right">
                    <div class="user-label">
                        <div class="user-avatar"><img src="images/no_avatar.png" alt="avatar" /></div>
                        <?= Yii::$app->user->getId() ?>
                        <b class="caret"></b>
                    </div>
                    <ul>
                        <li><a style="cursor: pointer" onclick="auth.sigout();">Sigout<span class="glyphicon glyphicon-off"></span></a></li>
                    </ul>
                </div><!-- /admin-right -->
                <ol class="breadcrumb" data-rel="breadcrumb" ></ol>
            </div><!-- /container -->
        </div><!-- /tree-view -->
        <div class="tree-line"></div>
        <div class="container" data-rel="container" >
            <?= Alert::widget() ?>
            <?= $content ?>
            <?php $this->endBody() ?>
        </div><!-- /container -->
        <div class="footer">
            <div class="container">
                © 2016 <a href="#">MinhDoan</a>
            </div><!-- /container -->
        </div><!-- footer -->
        <div class="top"></div>
        <div id="loading"><div class="loading-img">Loading...</div></div>
        <?php $this->registerJsFile('http://js.pusher.com/2.2/pusher.min.js'); ?>
        <script type="text/javascript" >
            var account = '<?= Yii::$app->user->getId() ?>';
            var baseUrl = '<?= $this->context->baseUrl; ?>';
            Fly.init({
                baseUrl: baseUrl,
                upload: 'upload',
                default: 'index',
                layout: layout.init(),
            });
<?= $this->context->staticClient; ?>
        </script>
    </body>
</html>
<?php $this->endPage() ?>
