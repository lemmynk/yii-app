<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon-new.ico" type="image/x-icon" />

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <?php $this->head() ?>
    </head>
    <body data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0">
    <?php $this->beginBody() ?>


    <!-- Navbar -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <?= $this->render('_navigation', ['content' => !empty($this->context->params['navigation']) ? $this->context->params['navigation'] : '']) ?>
        </div>
    </header>
    <!-- /.navbar -->

    <!-- Banner-->
        <?php // echo $this->render('_banner', ['content' => $this->context->params['banner']]) ?>
    <!-- / .banner -->




    <main id="main">
        <div class="breadcrumbs aos-init aos-animate" data-aos="fade-in">
            <div class="container">
                <h3>Центар за социјални рад са домским одељењем и дневним центром за смештај старих и пензионера</h3>
                <h2>Нови Кнежевац</h2>
            </div>
        </div>
        <section id="events" class="events">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-8 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <!-- Content Wrapper. Contains page content -->
                            <?= $this->render('_page_content', ['content' => $content]) ?>
                        <!-- /.content-wrapper -->
                    </div>
                    <div class="col-lg-4 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <!-- Main Sidebar Container -->
                        <?php //echo $this->render('_sidebar', ['content' => $this->context->params['sidebar']]) ?>
                        <!-- / .main sidebar -->
                    </div>
                </div>
            </div>
        </section>
    </main>


    <!-- Main Footer -->
    <?= $this->render('_footer', ['content' => $this->context->params['footer']]) ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
