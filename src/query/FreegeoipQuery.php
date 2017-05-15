<?php

namespace omny\yii2\city\component\query;

/**
 * This is the ActiveQuery class for [[\omny\yii2\city\component\entity\FreegeoipEntity]].
 *
 * @see \omny\yii2\city\component\entity\FreegeoipEntity
 */
class FreegeoipQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return \app\modules\city\entity\FreegeoipEntity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\city\entity\FreegeoipEntity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byCountryIcoCode($code)
    {
        return $this->andWhere(['country_iso_code' => $code]);
    }

    public function onlyRegions($countryIso = null)
    {
        if (is_null($countryIso)) {
            return $this->groupBy('subdivision_1_name')
                ->orderBy('subdivision_1_name');
        }

        return $this->andWhere(['country_iso_code' => $countryIso])
            ->groupBy('subdivision_1_name')
            ->orderBy('subdivision_1_name');
    }

    public function byRegionIsoCode($code)
    {
        return $this->andWhere(['subdivision_1_iso_code' => $code])
            ->orderBy('city_name');
    }
}
