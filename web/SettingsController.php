<?php

namespace yeesoft\settings\web;

use yeesoft\controllers\BaseController;
use Yii;

/**
 * SettingsController implements base actions for settings pages.
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
abstract class SettingsController extends BaseController
{

    /**
     * Layout file for admin panel
     *
     * @var string
     */
    public $layout = '@vendor/yeesoft/yii2-yee-core/views/layouts/main';

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
     * Lists all settings in the group.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Your settings have been saved.');
            return $this->redirect(['index']);
        }

        return $this->renderIsAjax($this->viewPath, compact('model'));
    }

}
