<?php

use yeesoft\helpers\Html;
use yeesoft\settings\assets\SettingsAsset;
use yeesoft\settings\models\GeneralSettings;
use yeesoft\settings\widgets\SettingsActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\models\Setting */
/* @var $form SettingsActiveForm */

$this->title = Yii::t('yee/settings', 'General Settings');
$this->params['breadcrumbs'][] = $this->title;

SettingsAsset::register($this);
?>

<div class="box box-primary">
    <div class="box-body">

        <?php $form = SettingsActiveForm::begin() ?>

        <?= $form->languageSwitcher($model); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true])/* ->hint($model->getDescription('description')) */ ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint($model->getDescription('email')) ?>

        <?= $form->field($model, 'dateformat', ['options' => ['class' => 'form-group select-field']])->dropDownList(GeneralSettings::getDateFormats())->hint($model->getDescription('dateformat')) ?>

        <?= $form->field($model, 'timeformat', ['options' => ['class' => 'form-group select-field']])->dropDownList(GeneralSettings::getTimeFormats())->hint($model->getDescription('timeformat')) ?>

        <?= $form->field($model, 'timezone', ['options' => ['class' => 'form-group select-field']])->dropDownList(GeneralSettings::getTimezones())->hint($model->getDescription('timezone')) ?>

        <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary pull-right']) ?>

        <?php SettingsActiveForm::end(); ?>

    </div>
</div>