<div class="contact">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Trang chủ</a></li>
            <li class="active">Liên hệ</li>
        </ol>
        <div class="contact-head">
            <h2>Liên hệ</h2>
            <form method="post">
                <div class="col-md-6 contact-left">
                    <input name="name" type="text" placeholder="Tên" required="">
                    <input name="email" type="text" placeholder="E-mail" required="">
                    <input name="phone" type="text" placeholder="Số điện thoại" required="">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                </div>
                <div class="col-md-6 contact-right">
                    <textarea name="content" placeholder="Nội dung"></textarea>
                    <input type="submit" value="Gửi">
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
<!--        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1578265.0941403757!2d-98.9828708842255!3d39.41170802696131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited+States!5e0!3m2!1sen!2sin!4v1407515822047"> </iframe>
        </div>-->
    </div>
</div>
<?php if($saved){ ?>
    <script type="text/javascript">
        alert('Cảm ơn bạn đã gửi liên hệ, chúng tôi sẽ liên lạc với bạn sớm nhất có thể, xin cảm ơn.');
    </script>
<?php } ?>
