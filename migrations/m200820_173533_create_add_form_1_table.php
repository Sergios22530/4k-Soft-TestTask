<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_form_1}}`.
 */
class m200820_173533_create_add_form_1_table extends Migration
{
    const TABLE_NAME = '{{%form_1}}';

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
            'post_description' => $this->string(500)->defaultValue(null)->null(),
            'salary' => $this->integer(11)->defaultValue(null)->null(),
            'date_start' => $this->integer(11)->defaultValue(null)->null(),
            'date_end' => $this->integer(11)->defaultValue(null)->null(),
            'created_at' => $this->integer(11)->defaultValue(null)->null()

        ], $tableOptions);


        $this->createIndex('idx_form_1_salary', self::TABLE_NAME, 'salary');
        $this->createIndex('idx_form_1_date_start', self::TABLE_NAME, 'date_start');
        $this->createIndex('idx_form_1_date_end', self::TABLE_NAME, 'date_end');
        $this->createIndex('idx_form_1_created_at', self::TABLE_NAME, 'created_at');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx_form_1_salary', self::TABLE_NAME);
        $this->dropIndex('idx_form_1_date_start', self::TABLE_NAME);
        $this->dropIndex('idx_form_1_date_end', self::TABLE_NAME);
        $this->dropIndex('idx_form_1_created_at', self::TABLE_NAME);

        $this->dropTable(self::TABLE_NAME);

        return true;
    }
}
