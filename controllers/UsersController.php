<?php


namespace app\controllers;


use app\models\Users;
use Yii;
use yii\web\Controller;

class UsersController extends Controller
{
    public function actionLogin()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);

    }

}