<?php

namespace app\models\systemModels;

use Yii;
use app\models\translations\SourceMessageTranslation;

/**
 * This is the model class for table "source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 * @property integer $status
 *
 * @property SourceMessageTranslation[] $sourceMessageTranslations
 */
class SourceMessage extends TranslateActiveRecord
{
    /**
     * @inheritdoc
     */
    public $langForeignKey = 'id';

    public $translationAttributes = [
        'message',
        'translation'
    ];

    public $translationClass = SourceMessageTranslation::class;

    public static function tableName()
    {
        return 'source_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category','message'], 'required'],
            [['category','message'],'filter','filter' => 'trim'],
            [['status'], 'integer'],
            [['category'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Категорія',
            'message' => 'Ідентифікатор перекладу (підкатегорія)',
            'status' => 'Ста/тус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessageTranslations()
    {
        return $this->hasMany(SourceMessageTranslation::class, ['id' => 'id']);
    }

}
