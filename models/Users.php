<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * Это модель для таблицы "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $access_token
 */
class Users extends ActiveRecord
{
    /**
     * Имя таблицы
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * Правила для полей
     */
    public function rules()
    {
        return [
            [['login', 'password', 'first_name', 'last_name', 'auth_key', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * Аттрибуты полей
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Фамилия',
            'last_name' => 'Имя',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }
}
