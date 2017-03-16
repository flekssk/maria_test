<?php

namespace app\modules\admin\controllers;

use app\models\UploadFile;
use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * PostController работает с данными в Post модели.
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
     * Вывод всех постов.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Post();
        $dataProvider = new ActiveDataProvider([
            'query' => $model::find(),
        ]);
        $model = new Post();
        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Выводит один пост.
     * @param integer $id - id поста который необходимо вывести
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if( Yii::$app->request->isPost ){
            $uploadsModel = new UploadFile();
            $image = UploadedFile::getInstance($model, 'image');
            $model->saveImage( $uploadsModel->saveFile( $image ) );
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveFile( $model );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'imageModel' => new UploadFile()
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
     * @return Возвращает модель искомого поста
     * @throws NotFoundHttpException - Если поста нет в базе данных выводит ошибку
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
    public function saveFile( $model )
    {
        $uploadsModel = new UploadFile();

        if( $image = UploadedFile::getInstance($model, 'image') )
            $model->saveImage( $uploadsModel->saveFile( $image, $model->image ) );
    }
}
