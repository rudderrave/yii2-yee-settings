<?php

namespace yeesoft\settings\db;

use Yii;
use ArrayObject;
use yii\base\Model;
use yii\validators\Validator;
use yeesoft\settings\components\AttributeDetails;
use yeesoft\multilingual\db\MultilingualLabelsTrait;
use yeesoft\multilingual\helpers\MultilingualHelper;
use yeesoft\settings\behaviors\MultilingualSettingsBehavior;

/**
 * @author Taras Makitra <makitrataras@gmail.com>
 */
abstract class SettingsModel extends Model
{

    use MultilingualLabelsTrait;

    /**
     * Array with fields descriptions
     *
     * @var array
     */
    private $_descriptions = [];

    /**
     * Returns current settings group.
     * @return string
     */
    abstract public function group();

    /**
     * @inheritdoc
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->initAttributeValues();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'multilingual' => [
                'class' => MultilingualSettingsBehavior::className(),
                'attributes' => $this->multilingualAttributes(),
            ]
        ];
    }

    /**
     * Returns a list of multilingual attributes.
     * @return array
     */
    public function multilingualAttributes()
    {
        return [];
    }

    /**
     * Creates validator objects based on the validation rules specified in [[rules()]].
     * Unlike [[getValidators()]], each time this method is called, a new list of validators will be returned.
     * @return ArrayObject validators
     * @throws InvalidConfigException if any validation rule configuration is invalid
     */
    public function createValidators()
    {
        $languages = array_keys(Yii::$app->languages);
        $multilingual = ['title', 'description'];

        $validators = new ArrayObject;
        foreach ($this->rules() as $rule) {
            if ($rule instanceof Validator) {
                $validators->append($rule);
            } elseif (is_array($rule) && isset($rule[0], $rule[1])) { // attributes, validator type
                $result = [];
                $attributes = (array) $rule[0];

                foreach ($attributes as $attribute) {
                    if (in_array($attribute, $multilingual)) {
                        foreach ($languages as $language) {
                            $result[] = MultilingualHelper::getAttributeName($attribute, $language);
                        }
                    } else {
                        $result[] = $attribute;
                    }
                }

                $validator = Validator::createValidator($rule[1], $this, $result, array_slice($rule, 2));
                $validators->append($validator);
            } else {
                throw new InvalidConfigException('Invalid validation rule: a rule must specify both attribute names and validator type.');
            }
        }

        return $validators;
    }

    /**
     *
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     *
     * @inheritdoc
     */
    public function attributes()
    {
        $attributes = $this->getAttributesDetails();
        return array_keys($attributes);
    }

    /**
     *
     * @inheritdoc
     */
    public function safeAttributes()
    {
        return $this->attributes();
    }

    /**
     * Save settings to database
     */
    public function save()
    {
        $attributes = $this->getAttributesDetails();
        foreach ($attributes as $attribute) {
            Yii::$app->settings->set([$attribute->group, $attribute->key, $attribute->language], $this->{$attribute->field});
        }
    }

    /**
     * Init values of attributes
     */
    protected function initAttributeValues()
    {
        $attributes = $this->getAttributesDetails();
        foreach ($attributes as $attribute) {
            $this->{$attribute->field} = Yii::$app->settings->getFromDB($attribute->group, $attribute->key, $attribute->language);
        }
    }

    /**
     * Generate list of attributes details object
     */
    protected function getAttributesDetails()
    {
        $result = [];
        $group = $this->group();
        $attributes = parent::attributes();
        $languages = array_keys(Yii::$app->languages);
        $multilingual = ($this->isMultilingual()) ? $this->getBehavior('multilingual')->attributes : [];

        foreach ($attributes as $attribute) {
            if (in_array($attribute, $multilingual)) {
                foreach ($languages as $language) {
                    $field = MultilingualHelper::getAttributeName($attribute, $language);
                    $result[$field] = new AttributeDetails($field, $group, $attribute, $language);
                }
            } else {
                $result[$attribute] = new AttributeDetails($attribute, $group);
            }
        }

        return $result;
    }

    /**
     * Get setting field description
     *
     * @param string $key
     */
    public function getDescription($key)
    {
        return (isset($this->_descriptions[$key])) ? $this->_descriptions[$key] : '';
    }

    /**
     * Whether has model multilingual behavior
     *
     * @return boolean
     */
    public function isMultilingual()
    {
        return ($this->getBehavior('multilingual') !== null);
    }

}
