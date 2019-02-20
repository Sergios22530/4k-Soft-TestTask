<?php

use yii\db\Migration;

/**
 * Class m190220_080753_create_source_message_tabel
 */
class m190220_080753_create_source_message_tabel extends Migration
{
    const TABLE_NAME = '{{%source_message}}';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'category' => $this->string(32)->notNull(),
            'message' => $this->text()->null(),
            'status' => $this->integer(1)->defaultValue(1),
        ],$tableOptions);

        $this->createIndex('idx_source_message_status', self::TABLE_NAME, 'status');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
