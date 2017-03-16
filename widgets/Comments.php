<?php

namespace app\widgets;


use app\controllers\CommentsController;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * Виджет добавления коментарие
 */
class Comments extends Widget
{
    public $postId;


    /**
     * Виводит вид добавления коментариев
     * @return string - вид добавления коментариев
     */
    public function run()
    {
        $model = new \app\models\Comments();
        return $this->render('@app/views/comments/post_comments', [
            'commentsModel' => $model,
            'postId' => $this->postId
        ]);
    }
}