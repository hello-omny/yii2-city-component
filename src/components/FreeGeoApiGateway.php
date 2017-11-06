<?php

namespace omny\yii2\city\component\components;

use yii\base\Component;
use yii\httpclient\Client;

/**
 * Class FreeGeoApiGateway
 * @package omny\yii2\city\component\components
 */
class FreeGeoApiGateway extends Component
{
    public $apiRequest = "http://freegeoip.net";
    public $format = "json";
    public $ip;

    private $requestUrl = null;

    public function init()
    {
        parent::init();

        $this->setRequestUrl();
    }

    public function getData()
    {
        if (isset($this->ip)) {
            return $this->getResponse();
        }

        return null;
    }

    private function setRequestUrl()
    {
        $this->requestUrl = $this->apiRequest . "/" . $this->format . "/" . $this->ip;
    }

    private function getResponse()
    {
        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl($this->requestUrl)
                ->send();
        } catch (\Exception $exception) {
            \Yii::warning($exception->getMessage());
            return null;
        }

        if ($response->isOk) {
            return $response->data;
        }

        return null;
    }
}