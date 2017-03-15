<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CommentsController - выполняет действия работы с моделью Comments.
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
     * Вывод всех коментариев.
     * @return mixed - вывод вида
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
     * Вывод одного коментария.
     * @param integer $id - id коментария
     * @return mixed - вывод вида
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Редактирование коментариев.
     * Если обновление выполнено успешно перенаправляет к выводу этого комментария.
     * @param integer $id - id комментария
     * @return mixed
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
     * Удаление комментария
     * Если удаление выполнено успешно, перенаправляет к выводу всех комментариев
     * @param integer $id - id комментария
     * @return mixed - создание вида
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Поиск коментария по id.
     * Если такого коментария нет, выведет ошибку 404.
     * @param integer $id - id комментария
     * @return Объект с искомым коментарием
     * @throws NotFoundHttpException - невозможно найти коментарий
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Невозможно найти коментарий.');
        }
    }
}
