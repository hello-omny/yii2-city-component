<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\models\Freegeoip;

/**
 * Class CityListAction
 * @package omny\yii2\city\component\actions
 */
class CityListAction extends BaseAction
{
    public $viewTitle = 'Выберете город';
    public $itemViewFile = '_item-city';

    public function run($id)
    {
        $this->setRegionCookie($id);
        $regionModel = \Yii::$app->city->getRegion();

        $models = Freegeoip::find()
            ->byCountryIcoCode($regionModel->country_iso_code)
            ->byRegionIsoCode($regionModel->subdivision_1_iso_code)
            ->all();

        return $this->controller->render('list',
            [
                'models' => $models,
                'itemViewPath' => $this->itemViewFile,
                'mapTitle' => 'city_name',
                'searchTitle' => 'Города',
                'searchSelectedVal' => \Yii::$app->city->getCity()->id,
            ]);
    }
}