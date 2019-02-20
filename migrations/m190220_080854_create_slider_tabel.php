<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190220_080854_create_slider_tabel
 */
class m190220_080854_create_slider_tabel extends Migration
{
    const TABLE_NAME = '{{%slider}}';
    const TABLE_NAME_TRANSLATION = '{{%slider_translation}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'slider_type' => $this->integer(11)->notNull(),
            'file' => $this->string(255)->defaultValue(null)->null(),
            'status' => $this->smallInteger()->defaultValue(1),
            'sort_order' => $this->integer(11)->defaultValue(0),
            'created_at' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->defaultValue(null)
        ], $tableOptions);

        $this->createIndex('idx_slider_slider_type', self::TABLE_NAME, 'slider_type');
        $this->createIndex('idx_slider_status', self::TABLE_NAME, 'status');
        $this->createIndex('idx_slider_sort_order', self::TABLE_NAME, 'sort_order');
        $this->createIndex('idx_slider_created_at', self::TABLE_NAME, 'created_at');
        $this->createIndex('idx_slider_updated_at', self::TABLE_NAME, 'updated_at');

        $this->createTable(self::TABLE_NAME_TRANSLATION, [
            'slider_id' => Schema::TYPE_INTEGER,
            'language' => Schema::TYPE_STRING . '(16) NOT NULL',
            'title' => $this->string(255)->defaultValue(null)->null(),
            'description' => $this->string(255)->defaultValue(null)->null(),
            'image_alt' => $this->string(255)->defaultValue(null)->null()
        ], $tableOptions);
        $this->addPrimaryKey('', self::TABLE_NAME_TRANSLATION, ['slider_id', 'language']);
        $this->addForeignKey('slider_translation_to_slider', self::TABLE_NAME_TRANSLATION, 'slider_id', self::TABLE_NAME, 'id', 'CASCADE');


    }

    public function down()
    {
        $this->dropIndex('idx_slider_slider_type', self::TABLE_NAME);
        $this->dropIndex('idx_slider_status', self::TABLE_NAME);
        $this->dropIndex('idx_slider_sort_order', self::TABLE_NAME);
        $this->dropIndex('idx_slider_created_at', self::TABLE_NAME);
        $this->dropIndex('idx_slider_updated_at', self::TABLE_NAME);

        $this->dropForeignKey('slider_translation_to_slider', self::TABLE_NAME_TRANSLATION);

        $this->dropTable(self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME_TRANSLATION);
    }
}
