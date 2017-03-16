<?php

namespace app\modules\admin\controllers;

use app\models\Registrations;
use app\models\UsersAdministration;
use Yii;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Контроллер пользователей в админке
 */
class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Выводит всех пользоватей.
     * @return mixed - вид index
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Выводит одного пользователя.
     * @param integer $id - id пользователя
     * @return mixed - вид view
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создание нового пользователя.
     * Если создание прошло успешно вивод страницу информации.
     * @return mixed - модель create
     */
    public function actionCreate()
    {
        $model = new UsersAdministration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Обновление пользователя.
     * Если обновление прошло успешно возвращает вид update.
     * @param integer $id - id пользователя
     * @return mixed - вид update
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Удаляет пользователя.
     * Если удаление прошло успешно возвращает вид index.
     * @param integer $id - id пользователя
     * @return mixed - вид index
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Поиск модели пользователя.
     * Если такого пользователя нет возвращает ошибку.
     * @param integer $id - id пользователя
     * @return Users - модель пользователя
     * @throws NotFoundHttpException - данный пользователь не найден
     */
    protected function findModel($id)
    {
        if (($model = UsersAdministration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Данный пользователь не найден');
        }
    }
}
