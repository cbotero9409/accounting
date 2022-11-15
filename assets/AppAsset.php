<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/styles.css',
        'https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css',
        'css/ownStyle.css',
        'css/login.css'
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );

}
