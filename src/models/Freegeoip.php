<?php

namespace omny\yii2\geo\component\models;

use omny\yii2\geo\component\entity\FreegeoipEntity;

/**
 * Class Freegeoip
 * @package omny\yii2\geo\component\models
 */
class Freegeoip extends FreegeoipEntity
{
    const COOKIE_REGION_ID = 'cityComponent_regionIdValue';
    const COOKIE_CITY_ID = 'cityComponent_cityIdValue';
    const COOKIE_COUNTRY_ISO = 'cityComponent_countryIsoValue';
}
