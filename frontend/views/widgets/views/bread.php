<script type="text/javascript">
    var fistCat = '<?= isset($data[0]) ? $data[0]->id : '0' ?>';
</script>
<ol class="breadcrumb">
    <li><a href="<?= \yii\helpers\Url::base(true) ?>">Trang chủ</a></li>
    <li><a href="<?= \yii\helpers\Url::base(true) ?>/san-pham.html">Sản phẩm</a></li>
    <?php $end = end($data)->id ?>
    <?php foreach ($data as $cat) { if($cat == null ){continue;} ?>
        <li class="<?= $end == $cat->id ? 'active' : '' ?>"><a href="<?= \common\util\UrlUtils::category($cat->id,$cat->name) ?>"><?= $cat->name ?></a></li>
    <?php } ?>
    <?php if((count($data) == 0 || $data[0] == null ) && !empty(Yii::$app->request->get('keyword'))){ ?>
        <li class="active">Tìm kiếm: <a href="<?= \yii\helpers\Url::current() ?>"><?= Yii::$app->request->get('keyword') ?></a></li>
    <?php } ?>
</ol>