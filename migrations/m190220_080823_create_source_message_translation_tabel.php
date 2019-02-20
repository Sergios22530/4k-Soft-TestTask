<?php

use yii\db\Migration;

/**
 * Class m190220_080823_create_source_message_translation_tabel
 */
class m190220_080823_create_source_message_translation_tabel extends Migration
{
    const TABLE_NAME_TRANSLATION = '{{%source_message_translation}}';

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

        $this->createTable(self::TABLE_NAME_TRANSLATION, [
            'id' => $this->integer(11),
            'language' => $this->string(16)->notNull(),
            'translation' => $this->text()->null(),
        ],$tableOptions);

        $this->addPrimaryKey('', 'source_message_translation', ['id', 'language']);
        $this->addForeignKey('source_message_translation_to_source_message','source_message_translation','id','source_message','id','CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable(self::TABLE_NAME_TRANSLATION);
    }
}
