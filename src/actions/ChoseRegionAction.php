<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;
use omny\yii2\city\component\models\Freegeoip;
use yii\base\Action;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Response;

/**
 * Class ChoseRegionAction
 * @package omny\yii2\city\component\actions
 */
class ChoseRegionAction extends Action
{
    public function run($id)
    {
        /** @var Response $response */
        $response = \Yii::$app->response;
        /** @var CookieCollection $cookieCollection */
        $cookieCollection = $response->cookies;

        /** @var CityComponent $cityComponent */
        $cityComponent = \Yii::$app->city;
        $cityComponent->setRegion($id);

        $cookie = new Cookie([
            'name' => Freegeoip::COOKIE_REGION_ID,
            'value' => $cityComponent->getRegion()->id,
            'expire' => strtotime("+1 month", time()),
        ]);
        $cookieCollection->add($cookie);

        return $response->redirect(['/city/default/' . CityComponent::ACTION_CHOSE_REGION]);
    }

}
