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
 * @property string $title
 * @property string $image
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
            [['title', 'text'], 'required'],
            [['image'], 'file', 'extensions' => "png, jpg"],
            [['image'], 'default', 'value' => $this->image],
            [['date'], 'default', 'value' => date("Y-m-d")],
            [['user_id'], 'default' , 'value' => Yii::$app->user->identity->id]
        ];
    }

    /**
     * Аттрибуты полей
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'user_id' => 'ID Пользователя',
            'date' => 'Дата',
            'text' => 'Текст',
            'image' => 'Изображение',
        ];
    }

    /**
     * Запись имени файла в базу данных
     */
    public function saveImage( $file_name )
    {
        $this->image = $file_name;
        $this->save();
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
