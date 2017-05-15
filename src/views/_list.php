<?php

/** @var $this \yii\web\View */
/** @var $models omny\yii2\city\component\models\Freegeoip[] */
/** @var $viewFile string */

$cityCount = count($models);
$cols = 3;
$bootstrapCols = ceil(12 / $cols);
$cellItemCount = ceil($cityCount / $cols);
$flag = 1;

?>
<div class="row">
    <div class="col-sm-<?= $bootstrapCols ?>">
        <ul class="list-unstyled">
            <?php
            /** @var omny\yii2\city\component\models\Freegeoip $city */
            foreach ($models as $model) :

                echo $this->render($viewFile, compact('model'));
                $flag++;

                if ($flag > $cellItemCount) :
                    $flag = 1;

                    echo "</ul></div>";
                    echo '<div class="col-sm-' . $bootstrapCols . '">';
                    echo '<ul class="list-unstyled">';
                endif;
            endforeach; ?>
        </ul>
    </div>
</div>
