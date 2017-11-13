<?php

namespace yeesoft\settings\behaviors;

use Yii;
use yii\base\Behavior;
use yeesoft\db\ActiveRecord;
use yii\base\InvalidConfigException;
use yeesoft\multilingual\behaviors\MultilingualBehaviorTrait;

class MultilingualSettingsBehavior extends Behavior
{
    
    use MultilingualBehaviorTrait;

    /**
     * List of multilingual attributes.
     * 
     * @var array
     */
    public $attributes;

    /**
     * Available languages. It can be a simple array ['en-US', 'es'] or an associative 
     * array ['en-US' => 'English', 'es' => 'Español'].
     * 
     * @var array
     */
    public $languages;

    /**
     * Multilingual attribute label pattern. Available variables: `{label}` - original 
     * attribute label, `{language}` - language name, `{code}` - language code.
     * 
     * @var string 
     */
    public $attributeLabelPattern = '{label} [{language}]';

    /**
     * @var string current language.
     */
    protected $_currentLanguage;

    /**
     * @var array language keys.
     */
    private $_languageKeys;

    /**
     * @var array multilingual attributes
     */
    private $_multilingualAttributes = [];

    /**
     * @var array multilingual attribute labels
     */
    private $_attributeLabels;

    /**
     * @inheritdoc
     */
    public function attach($owner)
    {
        /* @var $owner ActiveRecord */
        parent::attach($owner);

        $this->_currentLanguage = Yii::$app->language;

        $this->languages = Yii::$app->languages;

        if (array_values($this->languages) !== $this->languages) { //associative array
            $this->_languageKeys = array_keys($this->languages);
        } else {
            $this->_languageKeys = $this->languages;
            $this->languages = array_combine($this->languages, $this->languages);
        }

        foreach ($this->_languageKeys as $language) {
            foreach ($this->attributes as $attribute) {
                $this->setMultilingualAttribute($this->getAttributeName($attribute, $language), ''); //$translation->{$attributeName}
            }
        }
    }

}
