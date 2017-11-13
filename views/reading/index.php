<?php

use yeesoft\helpers\Html;
use yeesoft\settings\assets\SettingsAsset;
use yeesoft\settings\models\GeneralSettings;
use yeesoft\settings\widgets\SettingsActiveForm;

/* @var $this yii\web\View */
/* @var $model yeesoft\models\Setting */
/* @var $form yeesoft\widgets\ActiveForm */

$this->title = Yii::t('yee/settings', 'Reading Settings');
$this->params['breadcrumbs'][] = $this->title;

SettingsAsset::register($this);
?>

<div class="box box-primary">
    <div class="box-body">

        <?php $form = SettingsActiveForm::begin() ?>

        <?php // echo $form->languageSwitcher($model); ?>

        <?= $form->field($model, 'page_size')->textInput(['maxlength' => true])->hint($model->getDescription('page_size')) ?>

        <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary pull-right']) ?>

        <?php SettingsActiveForm::end(); ?>

    </div>
</div>


