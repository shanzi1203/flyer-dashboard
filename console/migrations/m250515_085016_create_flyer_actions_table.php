<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%flyer_actions}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%flyers}}`
 * - `{{%user}}`
 */
class m250515_085016_create_flyer_actions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%flyer_actions}}', [
            'id' => $this->primaryKey(),
            'flyer_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'action_type' => $this->string(50)->notNull(),
            'action_time'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ],$tableOptions);

        // creates index for column `flyer_id`
        $this->createIndex(
            '{{%idx-flyer_actions-flyer_id}}',
            '{{%flyer_actions}}',
            'flyer_id'
        );

        // add foreign key for table `{{%flyers}}`
        $this->addForeignKey(
            '{{%fk-flyer_actions-flyer_id}}',
            '{{%flyer_actions}}',
            'flyer_id',
            '{{%flyers}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-flyer_actions-user_id}}',
            '{{%flyer_actions}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-flyer_actions-user_id}}',
            '{{%flyer_actions}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%flyers}}`
        $this->dropForeignKey(
            '{{%fk-flyer_actions-flyer_id}}',
            '{{%flyer_actions}}'
        );

        // drops index for column `flyer_id`
        $this->dropIndex(
            '{{%idx-flyer_actions-flyer_id}}',
            '{{%flyer_actions}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-flyer_actions-user_id}}',
            '{{%flyer_actions}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-flyer_actions-user_id}}',
            '{{%flyer_actions}}'
        );

        $this->dropTable('{{%flyer_actions}}');
    }
}
