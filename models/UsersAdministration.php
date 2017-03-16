<?php

namespace app\models;
/**
 * Модель регистрации пользователя.
 */
class UsersAdministration extends Users
{

    /**
     * Правила полей регистрации
     * @return array - правила полей
     */
    public function rules()
    {
        return [
            ['username', 'unique'],
            [['password','username', 'is_admin'], 'required'],
            ['last_name', 'default', 'value' => $this->last_name],
            ['first_name', 'default', 'value' => $this->first_name]
        ];
    }
}