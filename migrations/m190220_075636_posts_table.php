<?php

use yii\db\Migration;

/**
 * Class m190220_075636_posts_table
 */
class m190220_075636_posts_table extends Migration
{
    const TABLE_NAME = '{{%post}}';
    const TABLE_NAME_TRANSLATION = '{{%post_translation}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'image' => $this->string(255)->null(),
            'inner_image' => $this->string(255)->null(),
            'category_id' => $this->integer(11)->defaultValue(null),
            'slug' => $this->string()->defaultValue(null),
            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->integer()->defaultValue(null),
            'updated_at' => $this->integer()->defaultValue(null),

        ],$tableOptions);

        $this->createTable(self::TABLE_NAME_TRANSLATION, [
            'post_id' => $this->integer(11),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'language' => $this->string(255),
            'image_alt' => $this->string(255)->null(),
            'meta_title' => $this->string(500)->defaultValue(null),
            'meta_keywords' => $this->string(500)->defaultValue(null),
            'meta_description' => $this->string(500)->defaultValue(null),
        ],$tableOptions);

        $this->createIndex('idx_post_category_id', self::TABLE_NAME, 'category_id');
        $this->createIndex('idx_post_status', self::TABLE_NAME, 'status');
        $this->createIndex('idx_post_created_at', self::TABLE_NAME, 'created_at');

        $this->addPrimaryKey('', self::TABLE_NAME_TRANSLATION, ['post_id', 'language']);
        $this->addForeignKey('post_translation_to_post','post_translation','post_id','post','id','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
        $this->dropTable(self::TABLE_NAME_TRANSLATION);
    }
}
