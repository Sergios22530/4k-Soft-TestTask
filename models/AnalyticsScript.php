<?php

namespace app\models;

use app\helpers\Status;
use yii\helpers\ArrayHelper;

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
class AnalyticsScript extends \yii\db\ActiveRecord
{
    const POS_HEAD = 1;
    const POS_BEGIN = 2;
    const POS_END = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analytics_script';
    }

    /**
     * Scripts to be inserted in the head section
     */
    public static function head()
    {
        echo implode("\n", self::getScripts());
    }

    /**
     * Scripts to be inserted at the beginning of the body section
     */
    public static function beginBody()
    {
        echo implode("\n", self::getScripts(self::POS_BEGIN));
    }

    /**
     * Scripts to be inserted at the end of the body section
     */
    public static function endBody()
    {
        echo implode("\n", self::getScripts(self::POS_END));
    }

    /**
     * Get all scripts
     * @param $position int
     * @return array
     */
    public static function getScripts($position = self::POS_HEAD)
    {
        $scripts = static::find()->select(['id', 'script'])
            ->where(['status' => Status::STATUS_ACTIVE, 'position' => $position])
            ->asArray()
            ->all();
        return ArrayHelper::map($scripts, 'id', 'script');
    }
}
