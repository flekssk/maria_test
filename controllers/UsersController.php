<?php


namespace app\controllers;


use app\models\Registrations;
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

    public function actionRegistration()
    {
        $model = new Registrations();

        if( $model->load(Yii::$app->request->post()) && $model->save() )
            $this->redirect('/users/login');

        return $this ->render('registration',[
            'model' => $model
        ]);
    }

}