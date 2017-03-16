<?php

namespace app\models;


class Registrations extends Users
{
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