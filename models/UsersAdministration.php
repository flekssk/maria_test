<?php

namespace app\models;

class UsersAdministration extends Users
{
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