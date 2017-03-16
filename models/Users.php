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
            'last_name' => 'Имя'
        ];
    }

    public function findByUsername($username)
    {
        return Users::find()->where(['username' => $username])->one();
    }

    public function login()
    {
        if( $this->validate() )
            return Yii::$app->user->login( $this->getUser() );

        return false;
    }

    public function validatePassword($attribute)
    {
        $user = $this->getUser();


        if( !$user || $this->password !== $user->password ){
            $this->addError($attribute, 'Логин или пароль введены не верно');
        }
    }


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
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return Users::findOne($id);
    }

    public function getUser()
    {
        if( $this->user === false ){
            $this->user = Users::findByUsername($this->username);
        }

        return $this->user;
    }
}
