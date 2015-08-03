<?php

namespace yeesoft\settings\controllers;

use yeesoft\base\controllers\admin\BaseController;
use Yii;

/**
 * BaseSettingsController implements base actions for settings pages.
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
abstract class BaseSettingsController extends BaseController
{

    /**
     * Settings model class.
     *
     * @var string
     */
    public $modelClass;

    /**
     * Path to view file for settings.
     *
     * @var string
     */
    public $viewPath;

    /**
     * Action where settings is located
     *
     * @var array
     */
    public $enableOnlyActions = ['index'];

    /**
     * Lists all settings in group.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect($this->enableOnlyActions);
        }

        return $this->renderIsAjax($this->viewPath, compact('model'));
    }
}