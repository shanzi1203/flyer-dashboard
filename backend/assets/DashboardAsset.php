<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    
  public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $css = [

        'plugins/fontawesome-free/css/all.min.css',
        'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'dist/css/adminlte.min.css',
    ];

    public $js = [

        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'dist/js/adminlte.js',
      

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
