<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190220_080723_create_analytics_script_tabel
 */
class m190220_080723_create_analytics_script_tabel extends Migration
{
    const TABLE_NAME = '{{%analytics_script}}';

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => Schema::TYPE_PK,
            'script' => Schema::TYPE_TEXT . ' NOT NULL',
            'description' => 'VARCHAR(1000) DEFAULT NULL',
            'position' => 'TINYINT(1) DEFAULT 1',
            'status' => 'TINYINT(1) DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createIndex('idx_analytics_script_status', self::TABLE_NAME, 'status');
        $this->createIndex('idx_analytics_script_position', self::TABLE_NAME, 'position');
        $this->createIndex('idx_analytics_script_created_at', self::TABLE_NAME, 'created_at');
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
