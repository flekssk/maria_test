<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* Страница вывода всех постов */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать Пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Пользователь',
                'value' => function( $data ) {
                    return $data->user->last_name." ".$data->user->last_name;
                }
            ],
            'date',
            'text',
            'image',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
