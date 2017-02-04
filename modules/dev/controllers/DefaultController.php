<?php

namespace app\modules\dev\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserSign;

/**
 * Default controller for the `dev` module
 */
class DefaultController extends Controller
{
    public $layout = 'main';    

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReg() {
        $model = new UserSign;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->reg($post)) {
                Yii::$app->session->setFlash('info', '注册新用户成功');
            } else {
                Yii::$app->session->setFlash('info', '注册新用户失败');
            }
        }
        $model->password = '';
        $model->repassword = '';
        return $this->render('reg', ['model' => $model]);
    }

    public function actionAjax() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $value = explode(":", $post['value']);
            $value = $value[0];
            return '{"id":"1","value":"123"}';
         }
    }
}
