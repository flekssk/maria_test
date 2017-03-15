<?php

namespace app\controllers;

use app\models\Comments;
use app\models\UploadFile;
use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController набор CRUD действий для модели Post в пользовательской части.
 */
class PostController extends Controller
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
     * Вывод все посты.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => new Post(),
            'imageModel' => new UploadFile()
        ]);
    }

    /**
     * Выводит один пост.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Добавление нового поста.
     * Если создание прошло успешно то перенаправляет в отображение этого поста.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Редактирование поста.
     * Если оредактирование прошло успешно перенаправляет в отображение этого поста.
     * @param integer $id - id поста для редактирования
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveFile( $model );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'imageModel' => new UploadFile()
            ]);
        }
    }

    /**
     * Удаление поста.
     * Если удаление успешно то перенаправляет ко списку всех постов.
     * @param integer $id - id поста для удаления
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Поиск модели поста по его id.
     * Если такого поста нет выводит ощибку 404.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Загрузка файла на сервер и добавление в базу данных.
     * @param ActiveForm $model - модель куда нужно добавить файл
     * @return Post the loaded model
     */
    private function saveFile( $model )
    {
        $uploadsModel = new UploadFile();

        if( $image = UploadedFile::getInstance($model, 'image') )
            $model->saveImage( $uploadsModel->saveFile( $image, $model->image ) );
    }

}
