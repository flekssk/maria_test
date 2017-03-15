<?php
/**
 * Created by PhpStorm.
 * User: Laotio
 * Date: 15.03.2017
 * Time: 13:09
 */

namespace app\widgets;


use app\controllers\CommentsController;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class Comments extends Widget
{
    public $postId;

    public function run()
    {
        $model = new \app\models\Comments();
        return $this->render('@app/views/comments/post_comments', [
            'commentsModel' => $model,
            'postId' => $this->postId
        ]);
    }
}