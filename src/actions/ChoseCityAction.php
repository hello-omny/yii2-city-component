<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;
use omny\yii2\city\component\models\Freegeoip;
use yii\base\Action;
use yii\web\Cookie;

/**
 * Class ChoseCityAction
 * @package omny\yii2\city\component\actions
 */
class ChoseCityAction extends Action
{
    public function run($id)
    {
        $response = \Yii::$app->response;

        /** @var CityComponent $city */
        $city = \Yii::$app->city;
        $city->setCity($id);

        $cityCookie = new Cookie([
            'name' => Freegeoip::COOKIE_CITY_ID,
            'value' => $city->getCity()->id,
            'expire' => strtotime("+1 month", time()),
        ]);
        $response->cookies->add($cityCookie);

        return $response->redirect(CityComponent::$returnUrl);
    }

}
