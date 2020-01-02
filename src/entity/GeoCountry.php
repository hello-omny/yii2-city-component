<?php

namespace omny\yii2\geo\component\entity;

use Yii;

/**
 * This is the model class for table "geo_country".
 *
 * @property int $id
 * @property int|null $fgi_id
 * @property string $code
 * @property string $name
 * @property string $name_ru
 * @property int $continent_id
 *
 * @property GeoCity[] $geoCities
 * @property GeoContinent $continent
 * @property GeoDivision[] $geoDivisions
 * @property GeoDivision2[] $geoDivision2s
 */
class GeoCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fgi_id', 'continent_id'], 'integer'],
            [['code', 'name', 'name_ru', 'continent_id'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 70],
            [['name_ru'], 'string', 'max' => 100],
            [['continent_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoContinent::className(), 'targetAttribute' => ['continent_id' => 'id']],
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
            'continent_id' => 'Continent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(GeoCity::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContinent()
    {
        return $this->hasOne(GeoContinent::className(), ['id' => 'continent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoDivisions()
    {
        return $this->hasMany(GeoDivision::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoDivision2s()
    {
        return $this->hasMany(GeoDivision2::className(), ['country_id' => 'id']);
    }
}
