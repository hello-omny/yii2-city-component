<?php

namespace omny\yii2\geo\component\entity;

use Yii;

/**
 * This is the model class for table "geo_city".
 *
 * @property int $id
 * @property int|null $fgi_id
 * @property string $slug
 * @property string $name
 * @property string $name_ru
 * @property int $division_id
 * @property int|null $division2_id
 * @property int $country_id
 *
 * @property GeoCountry $country
 * @property GeoDivision $division
 */
class GeoCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fgi_id', 'division_id', 'division2_id', 'country_id'], 'integer'],
            [['slug'], 'string', 'max' => 100],
            [['name', 'name_ru', 'division_id', 'country_id'], 'required'],
            [['name'], 'string', 'max' => 70],
            [['name_ru'], 'string', 'max' => 100],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoCountry::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['division_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeoDivision::className(), 'targetAttribute' => ['division_id' => 'id']],
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
            'name' => 'Name',
            'name_ru' => 'Name Ru',
            'division_id' => 'Division ID',
            'division2_id' => 'Division2 ID',
            'country_id' => 'Country ID',
        ];
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
    public function getDivision()
    {
        return $this->hasOne(GeoDivision::className(), ['id' => 'division_id']);
    }
}
