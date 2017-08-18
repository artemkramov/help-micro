<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/1/2016
 * Time: 1:51 PM
 */

namespace frontend\web\themes\virtue4d;


use yii\web\AssetBundle;
use yii\web\View;

class FrontendAsset extends AssetBundle
{

    public $sourcePath = "@frontend/web/themes/virtue4d/dist/";

    public $cssOptions = [
        'position' => View::POS_END
    ];

    public $css = [
    ];

    public $js = [
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