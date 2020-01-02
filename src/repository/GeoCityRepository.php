<?php

namespace omny\yii2\geo\component\repository;

use omny\yii2\geo\component\models\GeoCity;
use yii\web\NotFoundHttpException;

/**
 * Class GeoCityRepository
 * @package omny\yii2\geo\component\repository
 */
class GeoCityRepository
{
    /**
     * @param string $name
     * @return GeoCity
     * @throws NotFoundHttpException
     */
    public function getByName(string $name): GeoCity
    {
        $model = GeoCity::find()
            ->where(['name' => $name])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException("City {$name} not found!");
    }

    /**
     * @param string $slug
     * @return GeoCity
     * @throws NotFoundHttpException
     */
    public function getCityBySlug(string $slug): GeoCity
    {
        $city = GeoCity::findOne(['slug' => $slug]);

        if ($city !== null) {
            return $city;
        }

        throw new NotFoundHttpException('City not found.');
    }
}
