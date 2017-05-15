<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $models omny\yii2\city\component\models\Freegeoip[] */
/* @var $itemViewPath string */
/* @var $mapTitle string */
/* @var $searchTitle string */
/* @var $searchSelectedVal int */

?>
<div class="block block-page-title">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-header"><?= Html::encode($this->title); ?></h1>
            </div>
        </div>
    </div>
</div> <!-- /.block-page-title -->
<hr>
<?= $this->render('_search',
    [
        'mapTitle' => $mapTitle,
        'models' => $models,
        'title' => $searchTitle,
        'selectedValue' => $searchSelectedVal,
    ]) ?>

<div class="container">
    <?= $this->render(
        '_list',
        [
            'models' => $models,
            'viewFile' => $itemViewPath,
        ]) ?>
</div>
