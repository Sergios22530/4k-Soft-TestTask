<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "{{%form_2}}".
 *
 * @property int $id
 * @property string $company_name
 * @property string $post
 * @property string $name
 * @property string $email
 * @property int $created_at
 */
class Form2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_2}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['company_name', 'post', 'name', 'email'], 'string', 'max' => 255],
            [['company_name', 'post', 'name', 'email', 'created_at'], 'default', 'value' => null]
        ];
    }

    public function beforeValidate()
    {
        $this->created_at = Yii::$app->formatter->asTimestamp((!$this->created_at) ? time() : $this->created_at);
        return parent::beforeValidate();
    }

    /**
     * @throws InvalidConfigException
     */
    public function convertDates()
    {
        $this->created_at = Yii::$app->formatter->asDate($this->created_at, 'dd-MM-Y');;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'post' => 'Post',
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];
    }
}
