<?php

namespace omny\yii2\city\component\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

/**
 * Class FreeGeoApiGateway
 * @package omny\yii2\city\component\components
 */
class FreeGeoApiGateway extends Component
{
    private const API_URL = 'https://freegeoip.app';
    private const FORMAT_JSON = 'json';

    /** @var null */
    private $url = null;

    /**
     * @param string $ip
     * @return mixed|null
     */
    public function getData(string $ip)
    {
        // TODO: validate ip string
        $this->url = sprintf('%s/%s/%s', self::API_URL, self::FORMAT_JSON, $ip);

        return $this->getResponse();
    }

    /**
     * @return mixed|null
     */
    private function getResponse()
    {
        $client = new Client();

        try {
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl($this->url)
                ->send();

            if ($response->isOk) {
                return $response->data;
            }
        } catch (\Exception $exception) {
            Yii::warning($exception->getMessage());
            return null;
        }

        return null;
    }
}
