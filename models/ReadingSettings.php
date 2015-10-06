<?php

namespace yeesoft\settings\models;

use yii\helpers\ArrayHelper;

/**
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class ReadingSettings extends BaseSettingsModel
{
    const GROUP = 'reading';

    public $page_size;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),
            [
                [['page_size'], 'required'],
                [['page_size'], 'integer'],
            ]);
    }

    public function attributeLabels()
    {
        return [
            'page_size' => 'Page Size',
        ];
    }

}