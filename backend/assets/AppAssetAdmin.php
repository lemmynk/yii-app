<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 20/12/23
 * Time: 17:18
 */

namespace backend\assets;

use yii\web\AssetBundle;


class AppAssetAdmin extends AssetBundle
{
    //public $basePath = '@webroot';
    //public $baseUrl = '@web';
    public $css = [
        'adminlte/plugins/fontawesome-free/css/all.min.css',
        'adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'adminlte/plugins/jqvmap/jqvmap.min.css',
        'adminlte/dist/css/adminlte.min.css',
        'adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'adminlte/plugins/summernote/summernote-bs4.min.css',
    ];
    public $js = [
        'adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'adminlte/plugins/sparklines/sparkline.js',
        'adminlte/plugins/jqvmap/jquery.vmap.min.js',
        'adminlte/plugins/jquery-knob/jquery.knob.min.js',
        'adminlte/plugins/moment/moment.min.js',
        'adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'adminlte/plugins/summernote/summernote-bs4.min.js',
        'adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'adminlte/dist/js/adminlte.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}