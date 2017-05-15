<?php

/* @var $this \yii\web\View */
/* @var $regionModels \omny\yii2\city\component\models\Freegeoip[] */
/* @var $itemView string */
/* @var $listView string */
/* @var $mapTitle string */
/* @var $searchTitle string */
/* @var $searchSelectedVal int */

echo $this->render('@omny/yii2/city/component/views/_search', [
    'mapTitle' => $mapTitle,
    'models' => $regionModels,
    'title' => $searchTitle,
    'selectedValue' => $searchSelectedVal,
]);

echo $this->render($listView, [
    'models' => $regionModels,
    'viewFile' => $itemView
]);