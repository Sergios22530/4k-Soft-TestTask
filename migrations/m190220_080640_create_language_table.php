<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `language`.
 */
class m190220_080640_create_language_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'prefix' => 'VARCHAR(12) NOT NULL',
            'local' => 'VARCHAR(12) NOT NULL',
            'default' => 'TINYINT(1) DEFAULT 0',
            'status' => 'TINYINT(1) DEFAULT 1',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%language}}');

        return true;
    }
}
