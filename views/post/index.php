<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php if( !Yii::$app->user->isGuest ): ?>
    <div class="post-create">

        <h1>Добавить новый</h1>

        <?= $this->render('_form', [
            'model' => $model,
            'imageModel' => $imageModel
        ]) ?>

    </div>
<?php endif; ?>
