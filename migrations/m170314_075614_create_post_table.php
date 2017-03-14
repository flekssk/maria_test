<?php

use yii\db\Migration;

/**
 * Создание таблицы `post`.
 */
class m170314_075614_create_post_table extends Migration
{

    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'date' => $this->date(),
            'text' => $this->string(),
            'title' => $this->string()
        ]);

        $this->createIndex(
            'post_user_index',
            'post',
            'user_id'
        );

        $this->addForeignKey(
            'key_user_id',
            'post',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('post');
    }
}
