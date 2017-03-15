<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<h1>Добавить комментарий</h1>

<div class="comments-form">

    <?php $form = ActiveForm::begin(['action'=>'/comments/create']); ?>

    <?= $form->field($commentsModel, 'post_id')->hiddenInput(['value' => $postId])->label(false) ?>

    <?= $form->field($commentsModel, 'text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>