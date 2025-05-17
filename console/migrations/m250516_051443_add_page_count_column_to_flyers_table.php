<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%flyers}}`.
 */
class m250516_051443_add_page_count_column_to_flyers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%flyers}}', 'page_count', $this->integer()->defaultValue(1)->after('image_path'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%flyers}}', 'page_count');
    }
}
