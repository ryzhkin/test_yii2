<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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


</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Books', 'url' => ['/books/index']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>

<!--<script type="text/javascript" src="/vendors/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript" src="/vendors/moment-with-locales.min.js"></script>
<script type="text/javascript" src="/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

<link rel="stylesheet" href="/vendors/fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="/vendors/fancybox/jquery.fancybox.pack.js"></script>

<script type="text/javascript">
   $(document).ready(function () {
       $('.bdi').datetimepicker({
           locale: 'ru',
           format: 'DD/MM/YYYY'
       });
       $('.view-big-photo').off('click');
       $('.view-big-photo').on('click', function (e) {
           e.preventDefault();
           jQuery.fancybox('photo', {
               href: $(this).find('img').attr('src'),
               fitToView   : true,
               openEffect  : 'none',
               closeEffect : 'none',
               autoSize    : true
           });
       });
       $('.glyphicon-eye-open').off('click');
       $('.glyphicon-eye-open').on('click', function (e) {
           e.preventDefault();
           jQuery.fancybox('view', {
               // fancybox API options
               type: 'iframe',
               href: $(this).parent().attr('href'),
               fitToView   : false,
               openEffect  : 'none',
               closeEffect : 'none',
               maxWidth    : 1000,
               maxHeight   : 600,
               minHeight   : 300,
               height      : 300,
               minWidth    : 800
           });//*/
       });
   });
</script>

</body>
</html>
<?php $this->endPage() ?>
