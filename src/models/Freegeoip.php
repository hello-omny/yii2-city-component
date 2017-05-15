<?php

namespace omny\yii2\city\component\models;

use omny\yii2\city\component\entity\FreegeoipEntity;

/**
 * Class Freegeoip
 * @package omny\yii2\city\component\models
 */
class Freegeoip extends FreegeoipEntity
{
    const COOKIE_REGION_ID = 'cityComponent_regionIdValue';
    const COOKIE_CITY_ID = 'cityComponent_cityIdValue';
    const COOKIE_COUNTRY_ISO = 'cityComponent_countryIsoValue';

}
