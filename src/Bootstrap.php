<?php

namespace omny\yii2\city\component;

use omny\yii2\city\component\components\CityComponent;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    private $routes = [
        '/city/' . CityComponent::ACTION_REGION_LIST => '/city/default/' . CityComponent::ACTION_REGION_LIST,
    ];

    public function bootstrap($app)
    {
        $app->setComponents([
            'city' => CityComponent::className()
        ]);

        $app->setModules([
            'city' => Module::className(),
        ]);

        $app->getUrlManager()->addRules($this->routes, true);
    }
}