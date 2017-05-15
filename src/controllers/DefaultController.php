<?php

namespace omny\yii2\city\component\controllers;

use omny\yii2\city\component\actions\ChoseCityAction;
use omny\yii2\city\component\actions\ChoseRegionAction;
use omny\yii2\city\component\actions\ChoseRegionAjaxAction;
use omny\yii2\city\component\actions\CityListAction;
use omny\yii2\city\component\actions\RegionListAction;
use omny\yii2\city\component\components\CityComponent;
use yii\web\Controller;

/**
 * Class DefaultController
 * @package omny\yii2\city\component\controllers
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return array_merge(
            [
                CityComponent::ACTION_REGION_LIST => [
                    'class' => RegionListAction::className(),
                ],
                CityComponent::ACTION_CITY_LIST => [
                    'class' => CityListAction::className(),
                ],
                CityComponent::ACTION_CHOSE_CITY => [
                    'class' => ChoseCityAction::className(),
                ],
                CityComponent::ACTION_CHOSE_REGION => [
                    'class' => ChoseRegionAction::className(),
                ],
                CityComponent::ACTION_CHOSE_REGION_AJAX => [
                    'class' => ChoseRegionAjaxAction::className(),
                ]
            ],
            parent::actions()
        );
    }
}
