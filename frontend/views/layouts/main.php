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

        <script src="assets/js/jquery.min.js"></script> 
        <script src="assets/js/wow.min.js"></script> 
        <script src="assets/js/bootstrap.min.js"></script> 
        <script src="assets/js/slick.min.js"></script> 
        <script src="assets/js/jquery.li-scroller.1.0.js"></script> 
        <script src="assets/js/jquery.newsTicker.min.js"></script> 
        <script src="assets/js/jquery.fancybox.pack.js"></script> 
        <script src="assets/js/custom.js"></script>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>
        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
        <div class="container">
            <header id="header">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="header_top">
                            <div class="header_top_left">
                                <nav class="navbar navbar-inverse" role="navigation">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                                    </div>
                                    <div id="navbar" class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav main_nav">
                                            <li class="active"><a href="index.html"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>            
                                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Thiết kế nội thất</a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Thiết kế nội thất, kiến trúc nhà ở</a></li>
                                                    <li><a href="#">Thiết kế nội thất nhà ống</a></li>
                                                    <li><a href="#">Thiết kế nội thất chung cư</a></li>
                                                    <li><a href="#">Thiết kế nội thất biệt thự</a></li>
                                                    <li><a href="#">Thiết kế nội thất nhà đẹp</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Tư vấn thiết kế</a></li>
                                            <li><a href="#">Kiến trúc</a></li>
                                            <li class="<?= explode("?", Yii::$app->request->url)[0] == UrlUtils::news(false) ? 'active' : '' ?>"><a class="color4" href="<?= UrlUtils::news() ?>">Tin Tức</a></li>
                                            <li class="<?= Yii::$app->request->url == UrlUtils::about(false) ? 'active' : '' ?>"><a class="color5" href="<?= UrlUtils::about() ?>">Giới thiệu</a></li>
                                            <li class="<?= Yii::$app->request->url == UrlUtils::contact(false) ? 'active' : '' ?>"><a class="color6" href="<?= UrlUtils::contact() ?>">Liên hệ</a></li>
                                        </ul>
                                    </div>
                                </nav>
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
            <?= $content ?>
            <section id="newsSection">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="latest_newsarea"> <span>Social</span>
                            <!--ul id="ticker01" class="news_sticker">
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My First News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Second News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Third News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Four News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Five News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Six News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Seven News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail3.jpg" alt="">My Eight News Item</a></li>
                                <li><a href="#"><img src="images/news_thumbnail2.jpg" alt="">My Nine News Item</a></li>
                            </ul-->
                            <div class="social_area">
                                <ul class="social_nav">
                                    <li class="facebook"><a href="#"></a></li>
                                    <li class="twitter"><a href="#"></a></li>
                                    <li class="flickr"><a href="#"></a></li>
                                    <li class="pinterest"><a href="#"></a></li>
                                    <li class="googleplus"><a href="#"></a></li>
                                    <li class="vimeo"><a href="#"></a></li>
                                    <li class="youtube"><a href="#"></a></li>
                                    <li class="mail"><a href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
