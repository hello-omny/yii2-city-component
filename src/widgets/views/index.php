<?php

use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $current \omny\yii2\city\component\models\Freegeoip */
/* @var $regionModels \omny\yii2\city\component\models\Freegeoip[] */
/* @var $btnClass string */
/* @var $searchTitle string */
/* @var $searchSelectedVal int */

echo Html::a($current->city_name, '#', [
    'data' => ['toggle' => 'modal', 'target' => '#city-modal'],
    'class' => $btnClass,
]);

Modal::begin([
    'size' => Modal::SIZE_LARGE,
    'header' => '<h2>Выбор города</h2>',
    'id' => 'city-modal',
    'toggleButton' => false,
]);

Pjax::begin([
    'id' => 'cityComponentPjax',
    'enablePushState' => false
]);

echo $this->render('@omny/yii2/city/component/views/_search', [
    'models' => $regionModels,
    'mapTitle' => 'subdivision_1_name',
    'title' => $searchTitle,
    'selectedValue' => $searchSelectedVal,
]);

echo $this->render('@omny/yii2/city/component/views/_list', [
    'models' => $regionModels,
    'viewFile' => '@omny/yii2/city/component/widgets/views/_item-region',
    'mapTitle' => 'subdivision_1_name',
    'searchTitle' => 'Регионы',
    'searchSelectedVal' => Yii::$app->city->getRegion()->id,
]);

Pjax::end();

Modal::end();
