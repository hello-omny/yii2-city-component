<?php

namespace omny\yii2\geo\component\entity;

use Yii;

/**
 * This is the model class for table "geo_division".
 *
 * @property int $id
 * @property int|null $fgi_id
 * @property string $code
 * @property string $name
 * @property string $name_ru
 * @property int $country_id
 *
 * @property GeoCity[] $geoCities
 * @property GeoCountry $country
 * @property GeoDivision2[] $geoDivision2s
 */
class GeoDivision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_division';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fgi_id', 'country_id'], 'integer'],
            [['code', 'name', 'name_ru', 'country_id'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 150],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoCountry::className(), 'targetAttribute' => ['country_id' => 'id']],
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
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoCities()
    {
        return $this->hasMany(GeoCity::className(), ['division_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(GeoCountry::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeoDivision2s()
    {
        return $this->hasMany(GeoDivision2::className(), ['division_id' => 'id']);
    }
}
