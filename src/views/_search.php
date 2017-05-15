<?php

use kak\widgets\select2\Select2;
use yii\helpers\ArrayHelper;

/** @var $this \yii\web\View */
/** @var $models \omny\yii2\city\component\models\Freegeoip[] */
/** @var $mapTitle string */
/** @var $title string */
/** @var $selectedValue int */

?>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group" style="position: relative; z-index: 10">
            <label><?= $title ?></label>
            <?php
            echo Select2::widget([
                'selectLabel' => 'select all',
                'unselectLabel' => 'unselect all',
                'options' => [
                    'data-scroll-height' => 150,  // auto scroll
                    'data-item-width' => 100,  // 100|auto
                ],
                'multiple' => false,
                'value' => $selectedValue,
                'name' => 'types',
                'items' => ArrayHelper::map($models, 'id', $mapTitle),
            ]);
            ?>
        </div>
    </div>
</div>
