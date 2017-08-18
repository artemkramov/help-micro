<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/1/2016
 * Time: 1:51 PM
 */

namespace frontend\web\themes\helpMicro;


use yii\web\AssetBundle;
use yii\web\View;

class FrontendAsset extends AssetBundle
{

    public $sourcePath = "@frontend/web/themes/helpMicro/dist/";

    public $cssOptions = [
        'position' => View::POS_END
    ];

    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/animate.min.css',
        'css/prettyPhoto.css',
        'css/main.css',
        'css/responsive.css',
        'css/flags.css',
    ];

    public $js = [
        'js/lib/underscore-min.js',
        'js/lib/bootstrap.min.js',
        'js/lib/jquery.prettyPhoto.js',
        'js/lib/jquery.isotope.min.js',
        'js/lib/wow.min.js',
        'js/lib/main.js',
        'js/App.js'
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['forceCopy'] = true;
    }

    public $depends = [
        'yii\web\YiiAsset',
    ];


}