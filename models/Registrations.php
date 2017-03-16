<?php

namespace app\models;

/**
 * Это модель регистрации пользователей.
 */

class Registrations extends Users
{
    /**
     * Правила полей
     * @return array - правила полей
     */
    public function rules()
    {
        return [
            ['username', 'unique'],
            ['last_name', 'default', 'value' => $this->last_name],
            ['first_name', 'default', 'value' => $this->first_name],
            ['password', 'default', 'value' => $this->password],
        ];
    }
}