<?php

use yii\helpers\Html;
use omny\yii2\city\component\components\CityComponent;

/** @var $this \yii\web\View */
/** @var $model \omny\yii2\city\component\models\Freegeoip */

$link = Html::a(
    $model->city_name,
    [
        '/city/default/' . CityComponent::ACTION_CHOSE_CITY,
        'id' => $model->id
    ]
);
echo Html::tag('li', $link);