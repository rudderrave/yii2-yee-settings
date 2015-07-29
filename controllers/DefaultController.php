<?php

namespace yeesoft\settings\controllers;

use yeesoft\base\controllers\admin\BaseController;

/**
 * DefaultController implements the CRUD actions for Setting model.
 */
class DefaultController extends BaseController
{
    public $modelClass       = 'yeesoft\settings\models\Setting';
    public $modelSearchClass = 'yeesoft\settings\models\SettingSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}