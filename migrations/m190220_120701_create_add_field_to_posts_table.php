<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_field_to_posts`.
 */
class m190220_120701_create_add_field_to_posts_table extends Migration
{
    const TABLE_NAME = '{{%post_translation}}';

    public function up()
    {
        $this->addColumn(self::TABLE_NAME, 'inner_image_alt', $this->string(255)->defaultValue(null)->null());
    }

    public function down()
    {
        $this->dropColumn(self::TABLE_NAME, 'inner_image_alt');
    }
}
