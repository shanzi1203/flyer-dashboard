<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%flyer_product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%flyers}}`
 * - `{{%products}}`
 */
class m250515_082043_create_flyer_product_table extends Migration
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
        $this->createTable('{{%flyer_product}}', [
            'id' => $this->primaryKey(),
            'flyer_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ],$tableOptions);

        // creates index for column `flyer_id`
        $this->createIndex(
            '{{%idx-flyer_product-flyer_id}}',
            '{{%flyer_product}}',
            'flyer_id'
        );

        // add foreign key for table `{{%flyers}}`
        $this->addForeignKey(
            '{{%fk-flyer_product-flyer_id}}',
            '{{%flyer_product}}',
            'flyer_id',
            '{{%flyers}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-flyer_product-product_id}}',
            '{{%flyer_product}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-flyer_product-product_id}}',
            '{{%flyer_product}}',
            'product_id',
            '{{%products}}',
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
            '{{%fk-flyer_product-flyer_id}}',
            '{{%flyer_product}}'
        );

        // drops index for column `flyer_id`
        $this->dropIndex(
            '{{%idx-flyer_product-flyer_id}}',
            '{{%flyer_product}}'
        );

        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-flyer_product-product_id}}',
            '{{%flyer_product}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-flyer_product-product_id}}',
            '{{%flyer_product}}'
        );

        $this->dropTable('{{%flyer_product}}');
    }
}
