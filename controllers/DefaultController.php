<?php

namespace yeesoft\settings\controllers;

use yeesoft\settings\web\SettingsController;

/**
 * DefaultController implements General Settings page.
 *
 * @author Taras Makitra <makitrataras@gmail.com>
 */
class DefaultController extends SettingsController
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClass = $this->module->defaultSettingsModel;
        $this->viewPath = $this->module->defaultSettingsView;
    }

}
