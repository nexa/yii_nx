<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    public $layout = 'main';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReg() {
        $model = new User;
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

    public function actionLogin() {
        $model = new User;
        if (Yii::$app->request->isPost)  {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                Yii::$app->session->setFlash('info', '用户登陆成功');           
            } else {
                Yii::$app->session->setFlash('info', '用户登陆失败');
            }
        }
        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }
}
