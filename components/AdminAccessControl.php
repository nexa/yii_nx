<?php

namespace app\components;

use Yii;
use yii\web\ForbiddenHttpException;

class AdminAccessControl extends \yii\base\ActionFilter {
    public function beforeAction($action) {
       // throw new ForbiddenHttpException("Not Allowed!");
        return true;
    }
}
