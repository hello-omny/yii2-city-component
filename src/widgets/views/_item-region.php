<?php

use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model omny\yii2\city\component\models\Freegeoip */

$link = Html::a(
    $model->subdivision_1_name,
    [
        '/city/default/chose-region-ajax',
        'id' => $model->id
    ]
);
echo Html::tag('li', $link);