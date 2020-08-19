<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tree}}`.
 */
class m200817_180437_create_tree_table extends Migration
{
    const TABLE_NAME = '{{%tree}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->notNull(),
            'position' => $this->integer(11)->notNull(),
            'path' => $this->string(12288)->notNull(),
            'level' => $this->integer(11)->notNull()
        ], $tableOptions);

        $this->createIndex('idx_tree_position', self::TABLE_NAME, 'position');
        $this->createIndex('idx_tree_path', self::TABLE_NAME, 'path');
        $this->createIndex('idx_tree_level', self::TABLE_NAME, 'level');

        $this->batchInsert(self::TABLE_NAME, ['id', 'parent_id', 'position', 'path', 'level'], [
            [1, 1, 1, '1', 1]
        ]); // create root binary
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_tree_position', self::TABLE_NAME);
        $this->dropIndex('idx_tree_path', self::TABLE_NAME);
        $this->dropIndex('idx_tree_level', self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);
    }
}
