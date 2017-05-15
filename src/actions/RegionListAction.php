<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\models\Freegeoip;

/**
 * Class RegionListAction
 * @package omny\yii2\city\component\actions
 */
class RegionListAction extends BaseAction
{
    public $viewTitle = 'Выберете область';
    public $itemViewFile = '_item-region';

    public function run()
    {
        $models = Freegeoip::find()
            ->onlyRegions('RU')
            ->all();

        return $this->controller->render('list',
            [
                'models' => $models,
                'itemViewPath' => $this->itemViewFile,
                'mapTitle' => 'subdivision_1_name',
                'searchTitle' => 'Регионы',
                'searchSelectedVal' => \Yii::$app->city->getRegion()->id,
            ]);
    }
}