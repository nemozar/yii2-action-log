<?php

use yii\db\Migration;
use yii\db\Schema;


/**
 * Class m190819_131520_Logs
 */
class m190819_131520_Logs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('action_logs', [
            'id' => Schema::TYPE_PK,
            'time' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'url' => $this->text()->notNull(),
            'post_data' => Schema::TYPE_TEXT,
            'id_user' => Schema::TYPE_INTEGER,
            'controller' => Schema::TYPE_TEXT,
            'action' => Schema::TYPE_TEXT,
            'referer' => $this->text()
        ]);
        $this->createIndex(
            'action_logs_controller',
            'action_logs',
            'controller'
        );
        $this->createIndex(
            'action_logs_action',
            'action_logs',
            'action'
        );
        $this->createIndex(
            'action_logs_id_user',
            'action_logs',
            'id_user'
        );
        $this->createIndex(
            'action_logs_time',
            'action_logs',
            'time'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('action_logs');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190819_131520_Logs cannot be reverted.\n";

        return false;
    }
    */
}
