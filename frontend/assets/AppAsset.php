<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/animate.css/animate.min.css',
        'vendor/aos/aos.css',
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/bootstrap-icons/bootstrap-icons.css',
        'vendor/boxicons/css/boxicons.min.css',
        'vendor/remixicon/remixicon.css',
        'vendor/swiper/swiper-bundle.min.css',
        'css/style.css',
        //'css/site.css',
    ];
    public $js = [
        'vendor/purecounter/purecounter_vanilla.js',
        'vendor/aos/aos.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/swiper/swiper-bundle.min.js',
        'js/main-1.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset',
    ];
}
