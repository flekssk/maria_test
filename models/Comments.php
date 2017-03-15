<?php

namespace app\models;

use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use yii\base\Exception;
use \yii\db\ActiveRecord;

/**
 * Это модель для таблицы "comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $post_id
 * @property string $date
 * @property string $text
 */
class Comments extends ActiveRecord
{

    /**
     * Имя таблицы
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * Правила полей
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['date'], 'default', 'value' => date("Y-m-d")],
            [['post_id'], 'default', 'value' => $this->post_id],
            [['text'], 'default', 'value' => $this->text]

        ];
    }

    /**
     * Атрибуты полей
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'post_id' => 'ID Поста',
            'date' => 'Дата',
            'text' => 'Текст',
        ];
    }

    public function setPostId( $id )
    {
        if( $id )
            $this->post_id = $id;
        else
            throw new Exception("Не передан id поста");
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(),['id' => 'user_id']);
    }
}
