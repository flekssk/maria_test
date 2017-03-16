<?php

namespace app\controllers;

use Yii;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController набор CRUD действий с моделью Comments.
 */
class CommentsController extends Controller
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
     * Вывод всех коментов
     * @return mixed - возвращает вид index
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comments::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Выводит один пост.
     * @param integer $id - id комента
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Созадет коментарий.
     * Если создание прошло усппешно возвращает на страницу поста куда был добавлен коментарий.
     * @return mixed - возвращает вид создания коментария
     */
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->goBack( Url::toRoute([
                'post/view', 'id' => Yii::$app->request->post('Comments')['post_id']
            ]));
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Редактирует коментарий.
     * Если редактирование прошло успешно отображает данный коментарий.
     * @param integer $id - id редактируемого коментария
     * @return mixed - возвращает вид редактирования коментария
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
     * Удаляет коментрий.
     * Если удаление прошло успешно отображает пост где был данный коментарий.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['post/view', 'id'=> $model->post_id]);
    }

    /**
     * Поиск модели коментриев.
     * Если таковой нет отправляет ошибку.
     * @param integer $id - id коментария
     * @return - модель коментария
     * @throws NotFoundHttpException - ошибка не сущесвующего коментария
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая модель не существует');
        }
    }
}
