<?php

use yeesoft\helpers\Html;
use yeesoft\settings\assets\SettingsAsset;
use yeesoft\settings\models\GeneralSettings;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\models\Setting */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'General Settings';
$this->params['breadcrumbs'][] = $this->title;

SettingsAsset::register($this);
?>
<div class="setting-index">

    <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>

    <div class="setting-form">
        <?php
        $form = ActiveForm::begin([
            'id' => 'setting-form',
            'validateOnBlur' => false,
            'fieldConfig' => [
                'template' => "<div class=\"settings-group\"><div class=\"settings-label\">{label}</div>\n<div class=\"settings-field\">{input}\n{hint}\n{error}</div></div>"
            ],
        ])
        ?>

        <?=
        $form->field($model, 'title')->textInput(['maxlength' => true])
            ->hint($model->getDescription('title'))
        ?>

        <?=
        $form->field($model, 'description')->textInput(['maxlength' => true])
            ->hint($model->getDescription('description'))
        ?>

        <?=
        $form->field($model, 'email')->textInput(['maxlength' => true])
            ->hint($model->getDescription('email'))
        ?>

        <?=
        $form->field($model, 'timezone',
            ['options' => ['class' => 'form-group select-field']])
            ->dropDownList(GeneralSettings::getTimezones(), ['class' => ''])->hint($model->getDescription('timezone'))
        ?>

        <?=
        $form->field($model, 'dateformat',
            ['options' => ['class' => 'form-group select-field']])
            ->dropDownList(GeneralSettings::getDateFormats(), ['class' => ''])->hint($model->getDescription('dateformat'))
        ?>

        <?=
        $form->field($model, 'timeformat',
            ['options' => ['class' => 'form-group select-field']])
            ->dropDownList(GeneralSettings::getTimeFormats(), ['class' => ''])->hint($model->getDescription('timeformat'))
        ?>

        <div class="form-group">
            <?=
            Html::submitButton('<span class="glyphicon glyphicon-ok"></span> Save',
                ['class' => 'btn btn-primary'])
            ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>


