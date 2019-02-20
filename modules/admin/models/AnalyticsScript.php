<?php

namespace app\modules\admin\models;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "analytics_script".
 *
 * @property integer $id
 * @property string $script
 * @property string $description
 * @property integer $position
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class AnalyticsScript extends \app\models\AnalyticsScript
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['script'], 'required'],
            [['script'], 'string'],
            [['description'], 'string', 'max' => 1000],
            [['position', 'status', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * Returns a list of behaviors that this component should behave as.
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @param int $position
     * @return array|string
     */
    public function getPosition($position = null)
    {
        $data = [
            self::POS_HEAD => 'Виводити в head',
            self::POS_BEGIN => 'На початку body',
            self::POS_END => 'В кінці body',
        ];
        return ArrayHelper::getValue($data, $position, $data);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'script' => 'Script',
            'description' => 'Замітка для скрипта',
            'position' => 'Позиція',
            'status' => 'Статус',
            'created_at' => 'Дата створення',
            'updated_at' => 'Updated At',
        ];
    }
}
