<?php

namespace omny\yii2\geo\component\DTO;

/**
 * Class GeoPointDTO
 * @package omny\yii2\geo\component\DTO
 */
class GeoPointDTO
{
    /** @var string */
    private $address;
    /** @var float */
    private $lat;
    /** @var float */
    private $lng;

    /**
     * GeoPointDTO constructor.
     * @param string $address
     * @param float $lat
     * @param float $lng
     */
    public function __construct(string $address, float $lat, float $lng)
    {
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getLat(): float
    {
        return $this->lat;
    }

    /**
     * @return float
     */
    public function getLng(): float
    {
        return $this->lng;
    }
}
