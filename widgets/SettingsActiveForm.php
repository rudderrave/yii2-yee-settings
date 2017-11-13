<?php

namespace yeesoft\settings\widgets;

class SettingsActiveForm extends \yeesoft\widgets\ActiveForm
{

    /**
     * @inheritdoc
     */
    public $options = ['role' => 'form', 'class' => 'settings-form'];

    /**
     * @inheritdoc
     */
    public $validateOnBlur = false;

    /**
     * @inheritdoc
     */
    public $fieldConfig = [
        'template' => "<div class=\"settings-group\"><div class=\"settings-label\">{label}</div>\n<div class=\"settings-field\">{input}\n{hint}\n{error}</div></div>"
    ];

}
