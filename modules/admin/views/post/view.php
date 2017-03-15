<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* Страница вывода одного поста */
/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удаить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить пост ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Пользователь',
                'value' => $model->user->last_name." ".$model->user->last_name,
                'contentOptions' => ['class' => 'bg-red'],
                'captionOptions' => ['tooltip' => 'Tooltip'],
            ],
            'date',
            'text',
            'image',
        ],
    ]) ?>

</div>
