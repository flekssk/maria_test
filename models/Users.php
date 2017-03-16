<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class Users extends ActiveRecord implements IdentityInterface
{
    public $user = false;
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
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Аттрибуты полей
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'first_name' => 'Фамилия',
            'last_name' => 'Имя',
            'is_admin' => 'Администратор'
        ];
    }

    /**
     * Возвращает модель пользователя по username
     * @param $username - имя пользователя
     * @return array|null|ActiveRecord - модель пользователя
     */
    public function findByUsername($username)
    {
        return Users::find()->where(['username' => $username])->one();
    }

    /**
     * Авторизация пользователя
     * @return bool
     */
    public function login()
    {
        if( $this->validate() )
            return Yii::$app->user->login( $this->getUser() );

        return false;
    }

    /**
     * Проверка пароля.
     * Сверяет введённый пароль и пароль из базы данных
     * @param $attribute - атрибуты поля password
     */
    public function validatePassword($attribute)
    {
        $user = $this->getUser();


        if( !$user || $this->password !== $user->password ){
            $this->addError($attribute, 'Логин или пароль введены не верно');
        }
    }


    /**
     * Авторизация через access token
     * @param mixed $token
     * @param null $type
     * @return null|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Возвращает id пользователя
     * @return string|int id пользователя.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Возвращает авторизационный код
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Проверка авторизационного ключа.
     *
     * Срабатывает если включено автологирование.
     * @param string $authKey - авторизационный код
     * @return bool
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
    }

    /**
     * Поиск модели пользователя
     * @param string|int id пользователя
     * @return IdentityInterface модель пользователя.
     */
    public static function findIdentity($id)
    {
        return Users::findOne($id);
    }

    /**
     * Возвращает модель пользователя
     * @return array|bool|null|ActiveRecord - модель пользователя
     */
    public function getUser()
    {
        if( $this->user === false ){
            $this->user = Users::findByUsername($this->username);
        }

        return $this->user;
    }

}
