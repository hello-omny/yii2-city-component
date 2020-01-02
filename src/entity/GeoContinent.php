<?php

namespace omny\yii2\geo\component\entity;

use Yii;

/**
 * This is the model class for table "geo_continent".
 *
 * @property int $id
 * @property int|null $fgi_id
 * @property string $code
 * @property string $name
 * @property string $name_ru
 *
 * @property GeoCountry[] $geoCountries
 */
class GeoContinent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_continent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fgi_id'], 'integer'],
            [['code', 'name', 'name_ru'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 20],
            [['name_ru'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fgi_id' => 'Fgi ID',
            'code' => 'Code',
            'name' => 'Name',
            'name_ru' => 'Name Ru',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCountries()
    {
        return $this->hasMany(GeoCountry::className(), ['continent_id' => 'id']);
    }
}
