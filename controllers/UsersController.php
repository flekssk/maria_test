<?php


namespace app\controllers;


use app\models\Registrations;
use app\models\Users;
use Yii;
use yii\web\Controller;

/**
 * Контроллер пользователей
 */

class UsersController extends Controller
{

    /**
     * Авторизация пользователя
     * Если были переданы данные, проверяет их и если проверка успешна пересылает назад
     * @return - Возвращает вид login
     */
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

    /**
     * Выход
     * @return Возвращает на главную страницу
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Регистрация пользователей
     * Если данный отправлены, проверяет их и если проверка успешна перенаправляет на страницу login
     * @return Возвращает вид registration
     */
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