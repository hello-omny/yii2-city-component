<?php

namespace omny\yii2\city\component\entity;

use \omny\yii2\city\component\query\FreegeoipQuery;

/**
 * This is the model class for table "freegeoip".
 *
 * @property integer $id
 * @property string $continent_code
 * @property string $continent_name
 * @property string $continent_name_en
 * @property string $country_iso_code
 * @property string $country_name
 * @property string $country_name_en
 * @property string $subdivision_1_iso_code
 * @property string $subdivision_1_name
 * @property string $subdivision_1_name_en
 * @property string $subdivision_2_iso_code
 * @property string $subdivision_2_name
 * @property string $subdivision_2_name_en
 * @property string $city_name
 * @property string $city_name_en
 * @property string $metro_code
 * @property string $time_zone
 */
class FreegeoipEntity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freegeoip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['continent_code', 'continent_name', 'continent_name_en', 'country_iso_code', 'country_name', 'country_name_en', 'subdivision_1_iso_code', 'subdivision_1_name', 'subdivision_1_name_en', 'subdivision_2_iso_code', 'subdivision_2_name', 'subdivision_2_name_en', 'city_name', 'city_name_en', 'metro_code', 'time_zone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'continent_code' => 'Continent Code',
            'continent_name' => 'Continent Name',
            'continent_name_en' => 'Continent Name En',
            'country_iso_code' => 'Country Iso Code',
            'country_name' => 'Country Name',
            'country_name_en' => 'Country Name En',
            'subdivision_1_iso_code' => 'Subdivision 1 Iso Code',
            'subdivision_1_name' => 'Subdivision 1 Name',
            'subdivision_1_name_en' => 'Subdivision 1 Name En',
            'subdivision_2_iso_code' => 'Subdivision 2 Iso Code',
            'subdivision_2_name' => 'Subdivision 2 Name',
            'subdivision_2_name_en' => 'Subdivision 2 Name En',
            'city_name' => 'City Name',
            'city_name_en' => 'City Name En',
            'metro_code' => 'Metro Code',
            'time_zone' => 'Time Zone',
        ];
    }

    /**
     * @inheritdoc
     * @return FreegeoipQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FreegeoipQuery(get_called_class());
    }
}
