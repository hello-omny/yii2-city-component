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
        if (!($app instanceof \yii\console\Application)) {
            $app->setComponents([
                'city' => CityComponent::className()
            ]);

            $app->setModules([
                'city' => Module::className(),
            ]);

            \Yii::$app->city->init();

            $app->getUrlManager()->addRules($this->routes, true);
        }
    }
}