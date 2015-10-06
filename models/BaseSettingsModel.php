<?php

namespace yeesoft\settings\models;

use yeesoft\models\Setting;
use yii\base\Model;
use Yii;

/**
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class BaseSettingsModel extends Model
{
    /**
     * Array with fields descriptions
     *
     * @var array
     */
    private $_descriptions = [];

    /**
     * Load settings from DB
     *
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $settings = Setting::find()->filterWhere(['group' => static::GROUP])->all();

        foreach ($settings as $setting) {
            $this->setAttributes([$setting->key => $setting->value]);
            $this->_descriptions[$setting->key] = $setting->description;
        }
    }

    /**
     * Save settings to DB
     */
    public function save()
    {
        $settings = get_object_vars($this);
        unset($settings['_descriptions']);

        foreach ($settings as $key => $value) {
            $setting = Setting::findOne(['group' => static::GROUP, 'key' => $key]);
            if ($setting) {
                $setting->value = $value;
                $setting->save();
            } else {
                Yii::$app->settings->set([static::GROUP, $key], $value);
            }
        }
    }

    /**
     * Get setting description
     *
     * @param type $settingID
     */
    public function getDescription($settingID)
    {
        return (isset($this->_descriptions[$settingID])) ? $this->_descriptions[$settingID] : '';
    }
}