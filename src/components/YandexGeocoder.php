<?php

namespace omny\yii2\geo\component\components;

use omny\yii2\geo\component\DTO\GeoPointDTO;
use Yii;
use yii\base\BaseObject;
use yii\httpclient\Client;

/**
 * Class YandexGeocoder
 * @package omny\yii2\geo\component\components
 */
class YandexGeocoder extends BaseObject
{
    private const FORMAT_JSON = "json";
    private const METHOD = "get";
    private const API_URL = 'https://geocode-maps.yandex.ru/1.x';
    private const LANG_RU = 'ru_RU';

    /** @var string */
    private $apiKey;

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $address
     * @return GeoPointDTO
     */
    public function getCord(string $address): GeoPointDTO
    {
        $params = [
            'apikey' => $this->apiKey,
            'format' => self::FORMAT_JSON,
            'geocode' => $address,
            'lang' => self::LANG_RU,
        ];

        $response = $this->sendRequest($params);
        $cords = $this->parseResponse($response);

        return new GeoPointDTO($address, $cords['lat'], $cords['lng']);
    }

    /**
     * @param array $response
     * @return array
     */
    private function parseResponse(array $response) {
        $coordinates = [];
        if (array_key_exists('GeoObjectCollection', $response)) {
            $geoObjectCollection = $response['GeoObjectCollection'];

//            if (array_key_exists('metaDataProperty', $geoObjectCollection)
//                && array_key_exists('GeocoderResponseMetaData', $geoObjectCollection['metaDataProperty'])
//                && array_key_exists('found', $geoObjectCollection['metaDataProperty']['GeocoderResponseMetaData'])) {
//                $foundResults = $geoObjectCollection['metaDataProperty']['GeocoderResponseMetaData']['found'];
//            }

            if (array_key_exists('featureMember', $geoObjectCollection)
                && $geoObjectCollection['featureMember'] !== []) {
                $firstResult = $geoObjectCollection['featureMember']['0'];

                if (array_key_exists('GeoObject', $firstResult)
                    && array_key_exists('Point', $firstResult['GeoObject'])
                    && array_key_exists('pos', $firstResult['GeoObject']['Point'])) {
                    $point = $firstResult['GeoObject']['Point']['pos'];
                    $cords = explode(' ', $point);
                    $coordinates = [
                        'lat' => $cords[0],
                        'lng' => $cords[1],
                    ];
                }
            }

        }

        return $coordinates;
    }

    /**
     * @param array $params
     * @return mixed|null
     */
    private function sendRequest(array $params)
    {
        $client = new Client();
        try {
            $response = $client->createRequest()
                ->setMethod(self::METHOD)
                ->setUrl(self::API_URL)
                ->setData($params)
                ->send();

            if ($response->isOk) {
                return $response->data['response'];
            }
        } catch (\Throwable $exception) {
            Yii::warning($exception->getMessage());
        }

        return null;
    }
}
