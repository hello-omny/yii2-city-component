<?php

namespace omny\yii2\city\component\actions;

use omny\yii2\city\component\components\CityComponent;

/**
 * Class ChoseCityAction
 * @package omny\yii2\city\component\actions
 */
class ChoseCityAction extends BaseAction
{

    public function run($id)
    {
        $this->setCityCookie($id);

        return \Yii::$app->response->redirect(CityComponent::$returnUrl);
    }

}
