<?php

namespace app\models\translations;

use app\models\systemModels\SourceMessage;
use Yii;

/**
 * This is the model class for table "source_message_translation".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * @property SourceMessage $sourceMessage
 */
class SourceMessageTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_message_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['translation'],'required'],
            ['translation','filter','filter' => 'trim'],
            [['id', 'language','translation'], 'safe'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceMessage::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => 'Категорія',
            'language' => Yii::t('app','Language'),
            'translation' => 'Переклад',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessage()
    {
        return $this->hasOne(SourceMessage::class, ['id' => 'id']);
    }
}
