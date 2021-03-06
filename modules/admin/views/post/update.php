<?php

use app\models\UploadFile;
use yii\helpers\Html;


/* Страница редактирования поста */
/* @var $this yii\web\View */
/* @var $model app\models\Post */

$imageModel = new UploadFile();
$this->title = 'Update Post: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imageModel' => $imageModel
    ]) ?>

</div>
