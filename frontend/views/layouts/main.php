<?php
/* @var $this View */
/* @var $content string */

$category = ($this->context->var["category"]);
$newCustomerCate = ($this->context->var["newCustomerCare"]);

use common\util\TextUtils;
use common\util\UrlUtils;
use frontend\assets\FrontendAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

FrontendAsset::register($this);
//$this->registerJsFile('@web/js/qtools.js', ['depends' => ['\backend\assets\BackendAsset'], 'position' => \yii\web\View::POS_END,], 'qtools');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title data-rel="title" ><?= Html::encode($this->title == null || $this->title == "" ? $this->context->title : $this->title) ?></title>
        <meta name="keywords" content= "<?= $this->context->keywrod ?>" />
        <meta name="description" content="<?= $this->context->description ?>" />
        <meta property="og:title" content="<?= $this->context->og['title'] ?>" />
        <meta property="og:site_name" content="<?= $this->context->og['site_name'] ?>"/>
        <meta property="og:url" content="<?= $this->context->og['url'] ?>"/>
        <meta property="og:image" content="<?= $this->context->og['image'] ?>"/>
        <meta property="og:description"  content="<?= $this->context->og['description'] ?>" />
        <link rel="canonical" href="<?= $this->context->canonical ?>" />
        <?php $this->head() ?>
        <link href='http://fonts.googleapis.com/css?family=Montserrat|Raleway:400,200,300,500,600,700,800,900,100' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
            window.scrollTo(0, 1);
            } </script>
        <div class="top_bg">
            <div class="container">
                <div class="header_top-sec">
                    <div class="top_right">
                        <div class="logo">
                            <a href="index.html"><img src="images/logo.png"  style="width:200px;height:100px" alt=""/></a>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <div class="mega_nav">
            <div class="container">
                <div class="menu_sec">
                    <ul class="megamenu skyblue">
                        <li class="<?= explode("?", Yii::$app->request->url)[0] == UrlUtils::category(null, "", false) ? 'active' : '' ?> grid"><a class="color2" href="javascript:void(0)">Sản phẩm</a>
                            <div class="megapanel">
                                <div class="row">
                                    <?php
                                    foreach ($category as $catelv1) {
                                        if ($catelv1->level == 1 && $catelv1->parentId == 0) {
                                            ?>
                                            <div class="col1">
                                                <div class="h_nav">
                                                    <h4><?= $catelv1->name ?></h4>
                                                    <ul>
                                                        <?php
                                                        foreach ($category as $catelv2) {
                                                            if ($catelv2->parentId == $catelv1->id) {
                                                                ?>
                                                                <li><a href="<?= UrlUtils::category($catelv2->id, $catelv2->name) ?>"><?= $catelv2->name ?></a></li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>							
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                        <li class="<?= explode("?", Yii::$app->request->url)[0] == UrlUtils::news(false) ? 'active' : '' ?>"><a class="color4" href="<?= UrlUtils::news() ?>">Tin Tức</a></li>
                        <li class="<?= Yii::$app->request->url == UrlUtils::about(false) ? 'active' : '' ?>"><a class="color5" href="<?= UrlUtils::about() ?>">Giới thiệu</a></li>
                        <li class="<?= Yii::$app->request->url == UrlUtils::contact(false) ? 'active' : '' ?>"><a class="color6" href="<?= UrlUtils::contact() ?>">Liên hệ</a></li>
                    </ul>
                    <div class="search">
                        <form action="<?= Url::base() ?>/san-pham.html">
                            <input type="text" name="keyword" value="" placeholder="Tìm kiếm...">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?= $content ?>
        <div class="footer-content">
            <div class="container">
                <div class="ftr-grids">
                    <div class="col-md-3 ftr-grid" style="width:140px">
                        <h4>Mạng xã hội</h4>
                        <ul>
                            <li><a class="textdeco" href="https://www.facebook.com/Noithatminhdoan-655618487923074/"><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</a></li>
                            <li><a class="textdeco" href="#"><i class="fa fa-google" aria-hidden="true"></i> Google+</a></li>
                        </ul>

                    </div>
                    <div class="col-md-3 ftr-grid" style="width:400px">

                        <h4>LIÊN HỆ</h4>
                        <ul>
  <li>Địa chỉ </li>

<li>An Khánh - Hoài Đức - Hà Nội</li>

                            <li><a class="textdeco"><i class="fa fa-phone-square" aria-hidden="true"></i> 0913098883 - 0989140805</a></li>
                            <li><a class="textdeco" href="#"><i class="fa fa-envelope" aria-hidden="true"></i> noithatminhdoanh666@gmail.com</a></li>
                            <li><a class="textdeco" href="#"><i class="fa fa-skype" aria-hidden="true"></i> noithatminhdoan</a></li>
                        </ul>

                    </div>		
                    <?php if (!empty($newCustomerCate)) { ?>
                        <div class="col-md-3 ftr-grid">
                            <h4>Chăm sóc khách hàng</h4>
                            <ul>
                                <?php
                                foreach ($newCustomerCate as $newCustomer) {
                                    ?>
                                    <li><a href="<?= UrlUtils::newDetail($newCustomer->id, $newCustomer->name) ?>"><?= $newCustomer->name ?></a></li>
                                    <?php
                                }
                                ?>		
                            </ul>
                        </div>	
                    <?php } ?>
                    <div class="col-md-3 ftr-grid">
                        <h4>Danh mục</h4>
                        <ul>
                            <?php
                            foreach ($category as $catelv1) {
                                if ($catelv1->level == 1 && $catelv1->parentId == 0) {
                                    ?>
                                    <li><a href="<?= UrlUtils::category($catelv1->id, $catelv1->name) ?>"><?= $catelv1->name ?></a></li>
                                    <?php
                                }
                            }
                            ?>			 
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="copywrite">
                    <p>Copyright © 2016 Minh Đoàn 1</p>
                </div>
            </div>
        </div>
        
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
    <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="index.html">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="pages/contact.html">Contact</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <p>Friday, December 05, 2045</p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="index.html" class="logo"><img src="images/logo.jpg" alt=""></a></div>
          <div class="add_banner"><a href="#"><img src="images/addbanner_728x90_V1.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
  </header>
    <footer id="footer">
    <div class="footer_top">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInLeftBig">
            <h2>Flickr Images</h2>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInDown">
            <h2>Tag</h2>
            <ul class="tag_nav">
              <li><a href="#">Games</a></li>
              <li><a href="#">Sports</a></li>
              <li><a href="#">Fashion</a></li>
              <li><a href="#">Business</a></li>
              <li><a href="#">Life &amp; Style</a></li>
              <li><a href="#">Technology</a></li>
              <li><a href="#">Photo</a></li>
              <li><a href="#">Slider</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>Contact</h2>
            <p>Chuyên thiết kế nội thất nhà ở, cafe, chung cư, biệt thự. Với nhiều phong cách phù hợp với nhu cầu của khách hàng.
                Đội ngũ nhân viên năng động trẻ trung sẽ luôn làm hài lòng khách hàng.</p>
            <address>
            Ngõ 90 Nguyễn Tuân Hà Nội, USA Phone: 096.439.3333
            </address>
          </div>
        </div>
      </div>
    </div>
    <div class="footer_bottom">
      <p class="copyright">Copyright &copy; 2045 <a href="index.html">thiết kế nội thất</a></p>
      <p class="developer">Developed By xTeam</p>
    </div>
  </footer>
    
</div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
