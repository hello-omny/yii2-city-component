<?php

namespace omny\yii2\city\component\components;

use omny\yii2\city\component\models\Freegeoip;
use yii\base\Component;
use yii\web\Cookie;

/**
 * Class CityComponent
 * @package omny\yii2\city\component\components
 */
class CityComponent extends Component
{
    /** Actions */
    const ACTION_REGION_LIST = 'region-list';
    const ACTION_CITY_LIST = 'city-list';
    const ACTION_CHOSE_CITY = 'chose-city';
    const ACTION_CHOSE_REGION = 'chose-region';
    const ACTION_CHOSE_REGION_AJAX = 'chose-region-ajax';

    /** @var string */
    public static $returnUrl = '/';

    /** @var string */
    protected $testIp = '77.45.200.00';
    /** @var array */
    protected $testingIpList = ['::1', '127.0.0.1'];

    /** @var integer */
    protected $defaultCityId = 472045;
    /** @var integer */
    protected $defaultRegionId = 472039;

    /** @var Freegeoip */
    private $defaultRegion;
    /** @var Freegeoip */
    private $defaultCity;
    /** @var Freegeoip */
    private $city;
    /** @var Freegeoip */
    private $region;

    /**
     * Initializes the object.
     * This method is invoked at the end of the constructor after the object is initialized with the
     * given configuration.
     */
    public function init()
    {
        $this->defaultCity
            = $this->city
            = $this->findGeoIpModelById($this->defaultCityId);

        $this->defaultRegion
            = $this->region
            = $this->findGeoIpModelById($this->defaultRegionId);

        $this->setup([
            Freegeoip::COOKIE_REGION_ID => 'region',
            Freegeoip::COOKIE_CITY_ID => 'city',
        ]);

        $this->setupCountyIsoCode();

        parent::init();
    }

    /**
     * @param $id
     */
    public function setCity($id)
    {
        $this->city = $this->findGeoIpModelById($id);
    }

    /**
     * @param $id
     */
    public function setRegion($id)
    {
        $this->region = $this->findGeoIpModelById($id);
    }

    /**
     * @return Freegeoip
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return Freegeoip
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @return Freegeoip[]|null
     */
    public function getRegionCities()
    {
        return Freegeoip::find()
            ->where(['subdivision_1_iso_code' => $this->region->subdivision_1_iso_code])
            ->andWhere(['not', ['city_name' => null]])
            ->all();
    }

    /**
     * @param $options
     */
    private function setup($options)
    {
        $cookies = \Yii::$app->request->cookies;

        foreach ($options as $key => $property) {
            if ($cookies->has($key)) {
                $regionIdValue = $cookies->getValue($key);
                $this->$property = $this->findGeoIpModelById($regionIdValue);
            } else {
                $userValue = $this->getModelFromUserIp();
                if (!is_null($userValue)) {
                    $this->$property = $userValue;
                }
            }
        }
    }

    /**
     *
     */
    private function setupCountyIsoCode()
    {
        $countryIsoCode = $this->city->country_iso_code;
        $cookieCollection = \Yii::$app->response->cookies;
        $cookie = new Cookie([
            'name' => Freegeoip::COOKIE_COUNTRY_ISO,
            'value' => $countryIsoCode,
            'expire' => strtotime("+1 month", time()),
        ]);
        $cookieCollection->add($cookie);
    }

    /**
     * @return Freegeoip|array|null
     */
    private function getModelFromUserIp()
    {
        $geoIpModel = $this->getGeoIpModelByUserIP();

        if (!is_null($geoIpModel)) {
            return $geoIpModel;
        }

        return null;
    }

    /**
     * @param $id
     * @return Freegeoip|array|null
     */
    private function findGeoIpModelById($id)
    {
        $model = Freegeoip::find()
            ->where(['id' => $id])
            ->one();

        if (is_null($model)) {
            return $this->defaultRegion;
        }

        return $model;
    }

    /**
     * @return Freegeoip|array|null
     */
    private function getGeoIpModelByUserIP()
    {
        $request = \Yii::$app->request;

        $ip = $request->userIP;

        if (in_array($ip, $this->testingIpList)) {
            $ip = $this->testIp;
        }

        $freeGeoClient = new FreeGeoApiGateway([
            'ip' => $ip,
        ]);

        $response = $freeGeoClient->getData();

        if (!is_null($response)) {
            return $this->findGeoIpModel($response);
        }

        return null;
    }

    /**
     * @param $response
     * @return Freegeoip|array|null
     */
    private function findGeoIpModel($response)
    {
        return Freegeoip::find()
            ->where(['country_iso_code' => $response['country_code']])
            ->andWhere(['subdivision_1_name_en' => $response['region_name']])
            ->andWhere(['city_name_en' => $response['city']])
            ->one();
    }

}
