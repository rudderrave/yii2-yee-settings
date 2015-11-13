<?php

namespace yeesoft\settings;

use Yii;

class SettingsModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'yeesoft\settings\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['yee/settings'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/yeesoft/yii2-yee-settings/messages',
            'fileMap' => [
                'yee/settings' => 'settings.php',
            ],
        ];
    }

}