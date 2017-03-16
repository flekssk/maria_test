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
            'username' => $this->string(),
            'password' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'is_admin' => $this->boolean(),
            'auth_key' => $this->string(),
            'access_token' => $this->string()
        ]);

        $this->insert('users', [
            'id' => '1',
            'username' => 'admin',
            'password' => 'admin',
            'is_admin' => '1'
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
