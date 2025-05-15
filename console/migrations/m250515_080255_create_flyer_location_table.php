<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%flyer_location}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%flyers}}`
 * - `{{%locations}}`
 */
class m250515_080255_create_flyer_location_table extends Migration
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
        $this->createTable('{{%flyer_location}}', [
            'id' => $this->primaryKey(),
            'flyer_id' => $this->integer()->notNull(),
            'location_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ],$tableOptions);

        // creates index for column `flyer_id`
        $this->createIndex(
            '{{%idx-flyer_location-flyer_id}}',
            '{{%flyer_location}}',
            'flyer_id'
        );

        // add foreign key for table `{{%flyers}}`
        $this->addForeignKey(
            '{{%fk-flyer_location-flyer_id}}',
            '{{%flyer_location}}',
            'flyer_id',
            '{{%flyers}}',
            'id',
            'CASCADE'
        );

        // creates index for column `location_id`
        $this->createIndex(
            '{{%idx-flyer_location-location_id}}',
            '{{%flyer_location}}',
            'location_id'
        );

        // add foreign key for table `{{%locations}}`
        $this->addForeignKey(
            '{{%fk-flyer_location-location_id}}',
            '{{%flyer_location}}',
            'location_id',
            '{{%locations}}',
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
            '{{%fk-flyer_location-flyer_id}}',
            '{{%flyer_location}}'
        );

        // drops index for column `flyer_id`
        $this->dropIndex(
            '{{%idx-flyer_location-flyer_id}}',
            '{{%flyer_location}}'
        );

        // drops foreign key for table `{{%locations}}`
        $this->dropForeignKey(
            '{{%fk-flyer_location-location_id}}',
            '{{%flyer_location}}'
        );

        // drops index for column `location_id`
        $this->dropIndex(
            '{{%idx-flyer_location-location_id}}',
            '{{%flyer_location}}'
        );

        $this->dropTable('{{%flyer_location}}');
    }
}
