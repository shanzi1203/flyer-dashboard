<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%products}}`
 * - `{{%categories}}`
 */
class m250515_084203_create_product_category_table extends Migration
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
        $this->createTable('{{%product_category}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ],$tableOptions);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_category-product_id}}',
            '{{%product_category}}',
            'product_id'
        );

        // add foreign key for table `{{%products}}`
        $this->addForeignKey(
            '{{%fk-product_category-product_id}}',
            '{{%product_category}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            '{{%idx-product_category-category_id}}',
            '{{%product_category}}',
            'category_id'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-product_category-category_id}}',
            '{{%product_category}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%products}}`
        $this->dropForeignKey(
            '{{%fk-product_category-product_id}}',
            '{{%product_category}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_category-product_id}}',
            '{{%product_category}}'
        );

        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-product_category-category_id}}',
            '{{%product_category}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            '{{%idx-product_category-category_id}}',
            '{{%product_category}}'
        );

        $this->dropTable('{{%product_category}}');
    }
}
