<?php

namespace omny\yii2\geo\component\entity;

use Yii;

/**
 * This is the model class for table "geo_division2".
 *
 * @property int $id
 * @property int|null $fgi_id
 * @property string $code
 * @property string $name
 * @property string $name_ru
 * @property int $division_id
 * @property int $country_id
 *
 * @property GeoCountry $country
 * @property GeoDivision $division
 */
class GeoDivision2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_division2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fgi_id', 'division_id', 'country_id'], 'integer'],
            [['code', 'name', 'name_ru', 'division_id', 'country_id'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 100],
            [['name_ru'], 'string', 'max' => 150],
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
            'code' => 'Code',
            'name' => 'Name',
            'name_ru' => 'Name Ru',
            'division_id' => 'Division ID',
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
