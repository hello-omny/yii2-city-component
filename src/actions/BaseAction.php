<?php

namespace omny\yii2\city\component\actions;

use yii\base\Action;
use yii\base\InvalidConfigException;

/**
 * Class BaseAction
 * @package omny\yii2\city\component\actions
 */
class BaseAction extends Action
{
    public $viewPath = '@omny/yii2/city/component/views';
    public $viewTitle;
    public $itemViewFile;

    public function init()
    {
        $this->validateSettings();

        $controller = $this->controller;
        $view = $controller->view;

        $controller->viewPath = $this->viewPath;
        $view->title = $this->viewTitle;

        parent::init();
    }

    /**
     * @throws InvalidConfigException
     */
    private function validateSettings()
    {
        if (empty($this->viewTitle)) {
            throw new InvalidConfigException('ViewTitle must be set.');
        }

        if (empty($this->itemViewFile)) {
            throw new InvalidConfigException('ItemViewFile must be set.');
        }
    }
}