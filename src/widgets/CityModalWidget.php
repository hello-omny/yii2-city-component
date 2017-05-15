<?php

namespace omny\yii2\city\component\widgets;

use omny\yii2\city\component\components\CityComponent;
use omny\yii2\city\component\models\Freegeoip;
use yii\bootstrap\Widget;

/**
 * Class CityModalWidget
 * @package omny\yii2\city\component\widgets
 */
class CityModalWidget extends Widget
{
    /** @var string */
    public $btnClass = 'btn btn-default btn-sm';

    /** @var Freegeoip */
    private $city;
    /** @var Freegeoip[] */
    private $regionModels;


    public function init()
    {
        /** @var CityComponent $cityComponent */
        $cityComponent = \Yii::$app->city;
        $this->city = $cityComponent->getCity();
        $this->regionModels = $this->getRegionModels();

        parent::init();
    }

    public function run()
    {
        return $this->render('index', [
            'current' => $this->city,
            'regionModels' => $this->regionModels,
            'btnClass' => $this->btnClass,
            'searchTitle' => 'Регионы',
            'searchSelectedVal' => \Yii::$app->city->getRegion()->id,
        ]);
    }

    /**
     * @return Freegeoip[]|null
     */
    private function getRegionModels()
    {
        return Freegeoip::find()
            ->onlyRegions($this->getCountryCode())
            ->all();
    }

    /**
     * @return mixed|string
     */
    private function getCountryCode()
    {
        $countryIsoCode =  \Yii::$app->request->cookies->getValue(Freegeoip::COOKIE_COUNTRY_ISO);

        if (empty($countryIsoCode)) {
            return 'RU';
        }

        return $countryIsoCode;
    }
}