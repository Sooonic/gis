<?php
namespace gis\yii\user\migrations;

use gis\yii\user\User;
use yii\db\Migration;

class m170314_130941_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => 'SERIAL PRIMARY KEY',
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'main_role' => $this->string(64),
            'FOREIGN KEY (main_role) REFERENCES '
            . \Yii::$app->authManager->itemTable
            . '(name) ON DELETE SET NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
