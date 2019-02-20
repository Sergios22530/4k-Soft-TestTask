<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_field_to_posts`.
 */
class m190220_113941_create_add_field_to_posts_table extends Migration
{
    const TABLE_NAME = '{{%post}}';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, 'count_views', $this->integer()->defaultValue(0)->null());
        $this->createIndex('idx_graphic_post_content_count_views', self::TABLE_NAME, 'count_views');
    }

    public function down()
    {
        $this->dropIndex('idx_graphic_post_content_count_views', self::TABLE_NAME);
        $this->dropColumn(self::TABLE_NAME, 'count_views');
    }
}
