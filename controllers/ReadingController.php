<?php

namespace yeesoft\settings\controllers;

use yeesoft\settings\web\SettingsController;

/**
 * ReadingController implements Reading Settings page.
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class ReadingController extends SettingsController
{

    /**
     * @inheritdoc
     */
    public $modelClass = 'yeesoft\settings\models\ReadingSettings';

    /**
     * @inheritdoc
     */
    public $viewPath = '@vendor/yeesoft/yii2-yee-settings/views/reading/index';

}
