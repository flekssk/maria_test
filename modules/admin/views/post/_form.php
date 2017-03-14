<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* Вывод формы добавления и редактирования поста */
/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

print_r($model);
?>

<div class="post-form">

    <?php $form = ActiveForm::begin( ['options' => ['enctype' => 'multipart/form-data']] ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
