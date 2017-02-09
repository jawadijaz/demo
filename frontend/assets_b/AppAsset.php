<?php

namespace frontend\assets_b;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'
    ];
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
