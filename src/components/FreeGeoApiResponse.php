<?php


namespace omny\yii2\geo\component\components;

/**
 * Class FreeGeoApiResponse
 * @package omny\yii2\geo\component\components
 */
class FreeGeoApiResponse
{
    /** @var string */
    private $ip;
    /** @var string */
    private $countryCode;
    /** @var string */
    private $countryName;
    /** @var string */
    private $regionCode;
    /** @var string */
    private $regionName;
    /** @var string */
    private $city;
    /** @var string */
    private $zipCode;
    /** @var string */
    private $timeZone;
    /** @var float */
    private $latitude;
    /** @var float */
    private $longitude;
    /** @var int */
    private $metroCode;

    /**
     * FreeGeoApiResponse constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->configureFromArray($config);
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getRegionCode(): string
    {
        return $this->regionCode;
    }

    /**
     * @return string
     */
    public function getRegionName(): string
    {
        return $this->regionName;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @return int
     */
    public function getMetroCode(): int
    {
        return $this->metroCode;
    }
    
    /**
     * @param array $config
     */
    private function configureFromArray(array $config): void
    {
        if (!array_key_exists('ip', $config)) {
            throw new \RuntimeException('Free geo ip response failed. Ip key dose not exist.');
        }
        if (!array_key_exists('country_code', $config)) {
            throw new \RuntimeException('Free geo ip response failed. country_code dose not exist.');
        }
        if (!array_key_exists('country_name', $config)) {
            throw new \RuntimeException('Free geo ip response failed. country_name dose not exist.');
        }
        if (!array_key_exists('region_code', $config)) {
            throw new \RuntimeException('Free geo ip response failed. region_code dose not exist.');
        }
        if (!array_key_exists('region_name', $config)) {
            throw new \RuntimeException('Free geo ip response failed. region_name dose not exist.');
        }
        if (!array_key_exists('city', $config)) {
            throw new \RuntimeException('Free geo ip response failed. city dose not exist.');
        }
        if (!array_key_exists('zip_code', $config)) {
            throw new \RuntimeException('Free geo ip response failed. zip_code dose not exist.');
        }
        if (!array_key_exists('time_zone', $config)) {
            throw new \RuntimeException('Free geo ip response failed. time_zone dose not exist.');
        }
        if (!array_key_exists('latitude', $config)) {
            throw new \RuntimeException('Free geo ip response failed. latitude dose not exist.');
        }
        if (!array_key_exists('longitude', $config)) {
            throw new \RuntimeException('Free geo ip response failed. longitude dose not exist.');
        }
        if (!array_key_exists('metro_code', $config)) {
            throw new \RuntimeException('Free geo ip response failed. metro_code dose not exist.');
        }
        
        $this->ip = $config['ip'];
        $this->countryCode = $config['country_code'];
        $this->countryName = $config['country_name'];
        $this->regionCode = $config['region_code'];
        $this->regionName = $config['region_name'];
        $this->city = empty($config['city']) ? null : $config['city'];
        $this->zipCode = $config['zip_code'];
        $this->timeZone = $config['time_zone'];
        $this->latitude = $config['latitude'];
        $this->longitude = $config['longitude'];
        $this->metroCode = $config['metro_code'];
    }
}
