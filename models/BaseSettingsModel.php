<?php

namespace yeesoft\settings\models;

use yeesoft\helpers\LanguageHelper;
use yeesoft\models\Setting;
use Yii;
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

    public function attributes()
    {
        $settings = Setting::find()->filterWhere(['group' => static::GROUP])->all();
        $attributes = [];
        foreach ($settings as $setting) {
            $isLangAttr = ($setting->language && $setting->language != Yii::$app->language);
            $newKey = ($isLangAttr) ? $setting->key . '_' . $setting->language : $setting->key;
            $attributes[] = $newKey;

            if (!isset($this->$newKey)) {
                $this->$newKey = '';
            }
        }

        return $attributes;
    }

    public function safeAttributes()
    {
        return $this->attributes();
    }

    public function __construct($config = array())
    {
        parent::__construct($config);

        //Create lang setting if not exists for multilang settings
        if (($this->getBehavior('multilingualSettings') !== NULL)) {
            $languages = LanguageHelper::getLanguages();
            $attributes = $this->getBehavior('multilingualSettings')->attributes;

            //Get existing multilanguage settings
            $multilingualSettings = Setting::find()
                ->filterWhere(['group' => static::GROUP])
                ->filterWhere(['in','key',$attributes])
                ->all();

            $existingSettings = [];
            foreach ($multilingualSettings as $multilingualSetting) {
                $existingSettings[$multilingualSetting->key][$multilingualSetting->language] = TRUE;
            }

            //Create nonexisting settings
            foreach ($attributes as $attribute) {
                foreach ($languages as $language => $languageTitle) {
                    if(!isset($existingSettings[$attribute][$language])){
                        Yii::$app->settings->set([static::GROUP, $attribute, $language], '');
                    }
                }
            }

        }

        $settings = Setting::find()->filterWhere(['group' => static::GROUP])->all();

        foreach ($settings as $setting) {
            $isLangAttr = ($setting->language && $setting->language != Yii::$app->language);
            $newKey = ($isLangAttr) ? $setting->key . '_' . $setting->language : $setting->key;
            $this->$newKey = $setting->value;
            $this->_descriptions[$newKey] = $setting->description;
        }
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * Save settings to DB
     */
    public function save()
    {
        $languages = array_keys(LanguageHelper::getLanguages());

        $attributes = [];
        if (($this->getBehavior('multilingualSettings') !== NULL)) {
            $attributes = $this->getBehavior('multilingualSettings')->attributes;
        }

        $skipAttributes = [];
        $settings = get_object_vars($this);
        unset($settings['_descriptions']);

        foreach ($attributes as $key) {
            foreach ($languages as $language) {
                $field = $key . (($language == Yii::$app->language) ? '' : '_' . $language);
                $value = Yii::$app->getRequest()->post($field);
                Yii::$app->settings->set([static::GROUP, $key, $language], $this->$field);
                $skipAttributes[] = $field;
            }
        }

        foreach ($settings as $key => $value) {
            if (!in_array($key, $skipAttributes)) {
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