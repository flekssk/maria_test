<?php

namespace app\models;

use Yii;
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
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['post_id', 'text'], 'string', 'max' => 255],
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
}
