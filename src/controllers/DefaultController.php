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
    /**
     * @return array
     */
    public function actions(): array
    {
        return array_merge(
            parent::actions(),
            [
                CityComponent::ACTION_REGION_LIST => [
                    'class' => RegionListAction::class,
                ],
                CityComponent::ACTION_CITY_LIST => [
                    'class' => CityListAction::class,
                ],
                CityComponent::ACTION_CHOSE_CITY => [
                    'class' => ChoseCityAction::class,
                ],
                CityComponent::ACTION_CHOSE_REGION => [
                    'class' => ChoseRegionAction::class,
                ],
                CityComponent::ACTION_CHOSE_REGION_AJAX => [
                    'class' => ChoseRegionAjaxAction::class,
                ]
            ]
        );
    }
}
