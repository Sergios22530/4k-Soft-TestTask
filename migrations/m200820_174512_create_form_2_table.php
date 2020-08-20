<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_2}}`.
 */
class m200820_174512_create_form_2_table extends Migration
{
    const TABLE_NAME = '{{%form_2}}';

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
            'company_name' => $this->string(255)->defaultValue(null)->null(),
            'post' => $this->string(255)->defaultValue(null)->null(),
            'name' => $this->string(255)->defaultValue(null)->null(),
            'email' => $this->string(255)->defaultValue(null)->null(),
            'created_at' => $this->integer(11)->defaultValue(null)->null()

        ], $tableOptions);

        $this->createIndex('idx_form_2_created_at', self::TABLE_NAME, 'created_at');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_form_2_created_at', self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);

        return true;
    }
}
