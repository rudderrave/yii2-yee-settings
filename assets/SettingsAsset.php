<?php

namespace yeesoft\settings\assets;

use yii\web\AssetBundle;

class SettingsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/yeesoft/yii2-yee-settings/assets/source';
    public $css = [
        'css/settings.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'yeesoft\assets\YeeAsset'
    ];

}