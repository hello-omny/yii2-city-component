<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;
use omny\yii2\city\component\models\Freegeoip;
use Yii;
use yii\base\Action;
use yii\web\Cookie;

/**
 * Class AbstractAction
 * @package omny\yii2\city\component\actions
 */
abstract class AbstractAction extends Action
{
    public $viewPath = '@omny/yii2/city/component/views';
    public $viewTitle;
    public $itemViewFile;

    public function init()
    {
        $controller = $this->controller;
        $view = $controller->view;

        $controller->viewPath = $this->viewPath;
        $view->title = $this->viewTitle;

        parent::init();
    }

    /**
     * @param $id
     */
    protected function setRegionCookie(int $id)
    {
        /** @var CityComponent $cityComponent */
        $cityComponent = Yii::$app->city;
        $cityComponent->setRegion($id);

        $this->addCookie(
            Freegeoip::COOKIE_REGION_ID,
            $cityComponent->getRegion()->id,
            strtotime("+1 month", time())
        );
    }

    /**
     * @param $id
     */
    protected function setCityCookie(int $id)
    {
        /** @var CityComponent $cityComponent */
        $cityComponent = Yii::$app->city;
        $cityComponent->setCity($id);

        $this->addCookie(
            Freegeoip::COOKIE_CITY_ID,
            $cityComponent->getCity()->id,
            strtotime("+1 month", time())
        );
    }

    /**
     * @param $name string
     * @param $value int
     * @param $expire int
     */
    private function addCookie($name, $value, $expire)
    {
        $response = Yii::$app->response;

        $cityCookie = new Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => $expire,
        ]);

        $response->cookies->add($cityCookie);
    }
}