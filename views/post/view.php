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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
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
        <blockquote>
            <?= Html::tag('p', Html::encode($comment->text)) ?>
            <?= Html::tag('footer', Html::encode("Дата: ".$comment->date)) ?>
            <?= Html::tag('a', Html::tag("span", '', ['class' => 'glyphicon glyphicon-pencil']),[
                'href' => Url::toRoute(['comments/edit', 'id' => $comment->id])
            ])?>
            <?= Html::tag('a', Html::tag("span", '', ['class' => 'glyphicon glyphicon-trash']),[
                'href' => Url::toRoute(['comments/delete', 'id' => $comment->id]),
                'data-confirm' => 'Вы уверены что хотитет удалить пост?',
                'data-method' => 'post'
            ])?>
        </blockquote>
    <?php endforeach; ?>

    <?= Comments::widget(['postId'=> $model->id]) ?>
</div>
