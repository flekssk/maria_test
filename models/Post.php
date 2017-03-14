<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * Это модель для таблицы "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $text
 */
class Post extends ActiveRecord
{
    /**
     * Возвращает имя таблицы
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * Правила для полей
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * Аттрибуты полей
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID Пользователя',
            'date' => 'Дата',
            'text' => 'Текст',
        ];
    }
}
