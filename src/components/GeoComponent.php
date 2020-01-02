<?php

namespace omny\yii2\geo\component\components;

use omny\yii2\geo\component\models\GeoCity;
use omny\yii2\geo\component\models\GeoCountry;
use omny\yii2\geo\component\models\GeoDivision;
use omny\yii2\geo\component\repository\GeoCityRepository;
use yii\base\Component;

/**
 * Class GeoComponent
 * @package omny\yii2\geo\component\components
 */
class GeoComponent
{
    /**
     * @param string $ip
     * @return FreeGeoApiResponse|null
     */
    public function get(string $ip): ?FreeGeoApiResponse
    {
        $freeGeoClient = new FreeGeoApiGateway();
        return $freeGeoClient->get($ip);
    }

    /**
     * @param FreeGeoApiResponse $data
     * @return GeoCountry|null
     */
    public function getCounty(FreeGeoApiResponse $data): ?GeoCountry
    {
        // TODO: move to repository
        return GeoCountry::find()
            ->where(['name' => $data->getCountryName()])
            ->one();
    }

    /**
     * @param FreeGeoApiResponse $data
     * @return GeoDivision|null
     */
    public function getDivizion(FreeGeoApiResponse $data): ?GeoDivision
    {
        // TODO: move to repository
        return GeoDivision::find()
            ->where(['code' => $data->getRegionCode()])
            ->one();
    }

    /**
     * @param FreeGeoApiResponse $data
     * @return GeoCity|null
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     * @throws \yii\web\NotFoundHttpException
     */
    public function getCity(FreeGeoApiResponse $data): ?GeoCity
    {
        if ($data->getCity() === null) {
            return null;
        }

        /** @var GeoCityRepository $repository */
        $repository = \Yii::$container->get(GeoCityRepository::class);

        return $repository->getByName($data->getCity());
    }
}
