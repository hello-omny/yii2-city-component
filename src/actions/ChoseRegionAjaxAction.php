<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;
use omny\yii2\city\component\models\Freegeoip;
use yii\base\Action;
use yii\web\Cookie;
use yii\web\CookieCollection;
use yii\web\Response;

class ChoseRegionAjaxAction extends Action
{
    public $id = '/city/chose-region-ajax';

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

        $cityModels = Freegeoip::find()
            ->byCountryIcoCode($cityComponent->getRegion()->country_iso_code)
            ->byRegionIsoCode($cityComponent->getRegion()->subdivision_1_iso_code)
            ->all();

        $this->controller->viewPath = '@omny/yii2/city/widget/views';

        \Yii::$app->response->format = Response::FORMAT_HTML;

        return $this->controller->renderAjax('_regions',[
            'regionModels' => $cityModels,
            'mapTitle' => 'city_name',
            'listView' => '@omny/yii2/city/component/views/_list',
            'itemView' => '@omny/yii2/city/component/views/_item-city',
            'searchTitle' => 'Города',
            'searchSelectedVal' => \Yii::$app->city->getCity()->id,
        ]);
    }
}