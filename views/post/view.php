<?php

use app\widgets\Comments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if( Yii::$app->user->identity->is_admin || Yii::$app->user->identity->username === $model->user->username ):?>
        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены что хотитет удалить пост?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>

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
            'title',
            'image',
        ],
    ]) ?>


    <?php if( $model->comments ): ?>
        <h1>Комментарии</h1>
    <?php endif; ?>
    <?php foreach ($model->comments as $comment): ?>
        <h4>Автор: <?= Html::tag('span', Html::encode($comment->user->first_name." ".$comment->user->last_name));?></h4>
        <blockquote>
            <?= Html::tag('p', Html::encode($comment->text)) ?>
            <?= Html::tag('footer', Html::encode("Дата: ".$comment->date)) ?>
            <?php if( Yii::$app->user->identity->is_admin || Yii::$app->user->identity->username === $comment->user->username ):?>
                <?= Html::tag('a', Html::tag("span", '', ['class' => 'glyphicon glyphicon-pencil']),[
                    'href' => Url::toRoute(['comments/edit', 'id' => $comment->id])
                ])?>
                <?= Html::tag('a', Html::tag("span", '', ['class' => 'glyphicon glyphicon-trash']),[
                    'href' => Url::toRoute(['comments/delete', 'id' => $comment->id]),
                    'data-confirm' => 'Вы уверены что хотитет удалить пост?',
                    'data-method' => 'post'
                ])?>
            <?php endif; ?>
        </blockquote>
    <?php endforeach; ?>

    <?= Comments::widget(['postId'=> $model->id]) ?>
</div>
