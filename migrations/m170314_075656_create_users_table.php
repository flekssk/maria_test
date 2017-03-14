<?php

use yii\db\Migration;

/**
 * Создание таблицы `users`.
 */
class m170314_075656_create_users_table extends Migration
{

    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string(),
            'password' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'auth_key' => $this->string(),
            'access_token' => $this->string()
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
