<?php

use yii\db\Migration;

/**
 * Создание таблицы `comments`.
 */
class m170314_075711_create_comments_table extends Migration
{

    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'post_id' => $this->string(),
            'date' => $this->date(),
            'text' => $this->string()
        ]);

        $this->createIndex(
            'comment_post_index',
            'comments',
            'post_id'
        );

        $this->addForeignKey(
            'key_post_id',
            'comments',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('comments');
    }
}
