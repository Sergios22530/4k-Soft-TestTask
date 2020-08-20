<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "{{%form_1}}".
 *
 * @property int $id
 * @property string $company_name
 * @property string $post
 * @property string $post_description
 * @property int $salary
 * @property int $date_start
 * @property int $date_end
 * @property int $created_at
 */
class Form1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%form_1}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salary', 'date_start', 'date_end', 'created_at'], 'integer'],
            [['company_name', 'post'], 'string', 'max' => 255],
            [['post_description'], 'string', 'max' => 500],
            [['date_start', 'date_end', 'created_at', 'post_description', 'post', 'company_name'], 'default', 'value' => null]
        ];
    }

    public function beforeValidate()
    {
        $this->salary = (int)$this->salary;
        $this->date_start = Yii::$app->formatter->asTimestamp($this->date_start);
        $this->date_end = Yii::$app->formatter->asTimestamp($this->date_end);
        $this->created_at = Yii::$app->formatter->asTimestamp($this->created_at);

        return parent::beforeValidate();
    }

    /**
     * @throws InvalidConfigException
     */
    public function convertDates()
    {
        $this->date_start = Yii::$app->formatter->asDate($this->date_start, 'dd-MM-Y');
        $this->date_end = Yii::$app->formatter->asDate($this->date_end, 'dd-MM-Y');
        $this->created_at = Yii::$app->formatter->asDate($this->created_at, 'dd-MM-Y');
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
            'post_description' => 'Post Description',
            'salary' => 'Salary',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'created_at' => 'Created At',
        ];
    }
}
