<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;

/**
 * Class ChoseRegionAction
 * @package omny\yii2\city\component\actions
 */
class ChoseRegionAction extends AbstractAction
{
    public function run($id)
    {
        $this->setRegionCookie($id);

        return \Yii::$app->response->redirect(['/city/default/' . CityComponent::ACTION_CHOSE_REGION]);
    }

}
