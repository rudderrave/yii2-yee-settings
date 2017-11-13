<?php

namespace yeesoft\settings\components;

/**
 * AttributeDetails.
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class AttributeDetails
{

    public $field;
    public $group;
    public $key;
    public $language;
    public $multilingual;

    public function __construct($field, $group, $key = null, $language = null)
    {
        $this->field = $field;
        $this->group = $group;
        $this->key = ($key === null) ? $field : $key;
        $this->language = $language;
        $this->multilingual = ($language === null) ? false : true;
    }

}
