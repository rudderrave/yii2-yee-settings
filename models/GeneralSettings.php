<?php

namespace yeesoft\settings\models;

use Yii;
use yii\helpers\ArrayHelper;
use yeesoft\settings\db\SettingsModel;

/**
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class GeneralSettings extends SettingsModel
{

    public $title;
    public $description;
    public $email;
    public $timezone;
    public $dateformat;
    public $timeformat;

    /**
     * @inheritdoc
     */
    public function group()
    {
        return 'general';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
                    [['title', 'email', 'timezone', 'dateformat', 'timeformat'], 'required'],
                    [['email'], 'email'],
                    [['description'], 'string'],
                    ['title', 'default', 'value' => 'My Site'],
                    ['timezone', 'default', 'value' => 'Europe/London'],
                    ['dateformat', 'default', 'value' => 'F j, Y'],
                    ['timeformat', 'default', 'value' => 'g:i a'],
        ]);
    }

    public function multilingualAttributes()
    {
        return ['title', 'description'];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('yee/settings', 'Site Title'),
            'description' => Yii::t('yee/settings', 'Site Description'),
            'email' => Yii::t('yee/settings', 'Admin Email'),
            'timezone' => Yii::t('yee/settings', 'Timezone'),
            'dateformat' => Yii::t('yee/settings', 'Date Format'),
            'timeformat' => Yii::t('yee/settings', 'Time Format'),
        ];
    }

    public static function getDateFormats()
    {
        $timestamp = strtotime(date("Y") . '-01-22');
        return [
            'medium' => Yii::$app->formatter->asDate($timestamp, "medium"),
            'long' => Yii::$app->formatter->asDate($timestamp, "long"),
            'full' => Yii::$app->formatter->asDate($timestamp, "full"),
            'yyyy-MM-dd' => Yii::$app->formatter->asDate($timestamp, "yyyy-MM-dd"),
            'dd/MM/yyyy' => Yii::$app->formatter->asDate($timestamp, "dd/MM/yyyy"),
            'MM/dd/yyyy' => Yii::$app->formatter->asDate($timestamp, "MM/dd/yyyy"),
            'dd.MM.yyyy' => Yii::$app->formatter->asDate($timestamp, "dd.MM.yyyy"),
        ];
    }

    public static function getTimeFormats()
    {
        $timestamp = strtotime('2015-01-01 21:45:59');
        return [
            'hh:mm a' => Yii::$app->formatter->asTime($timestamp, "hh:mm a"),
            'HH:mm' => Yii::$app->formatter->asTime($timestamp, "HH:mm"),
        ];
    }

    public static function getTimezones()
    {
        $timezones = [];

        foreach (timezone_identifiers_list() as $zone) {
            $date = new \DateTime("now", new \DateTimeZone($zone));
            $timezones[$zone] = 'UTC' . $date->format('P') . ' ' . str_replace(['/', '_'], [' - ', ' '], $zone);
        }

        asort($timezones);

        return $timezones;
    }

}
