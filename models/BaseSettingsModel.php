<?php

namespace yeesoft\settings\models;

use yii\base\Model;

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
            $this->{$setting->key} = $setting->value;
            $this->_descriptions[$setting->key] = $setting->description;
        }
    }

    /**
     * Save settings to DB
     */
    public function save()
    {
        $settings = get_object_vars($this);

        foreach ($settings as $key => $value) {
            $setting = Setting::findOne(['group' => static::GROUP, 'key' => $key]);
            if ($setting) {
                $setting->value = $value;
                $setting->save();
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