<?php

/**
 * @link http://www.yee-soft.com/
 * @copyright Copyright (c) 2015 Taras Makitra
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

namespace yeesoft\settings;

/**
 * Settings Module For Yee CMS
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class SettingsModule extends \yii\base\Module
{

    /**
     * Version number of the module.
     */
    const VERSION = '0.2.0';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'yeesoft\settings\controllers';

    /**
     * @inheritdoc
     */
    public $defaultSettingsModel = 'yeesoft\settings\models\GeneralSettings';

    /**
     * @inheritdoc
     */
    public $defaultSettingsView = '@vendor/yeesoft/yii2-yee-settings/views/default/index';

}
