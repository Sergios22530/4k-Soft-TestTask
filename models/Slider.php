<?php

namespace app\models;

use app\models\systemModels\TranslateActiveRecord;
use app\models\translations\SliderTranslation;
use Yii;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property int $id
 * @property int $slider_type
 * @property string $file
 * @property int $status
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property SliderTranslation[] $sliderTranslations
 */
class Slider extends TranslateActiveRecord
{
    const SLIDER_TYPE_IMAGE = 1;
    const SLIDER_TYPE_VIDEO = 2;

    const UPLOAD_FOLDER_IMAGE = 'slider/image/';
    const UPLOAD_FOLDER_VIDEO = 'slider/video/';

    public $langForeignKey = 'slider_id';

    public $translationAttributes = [
        'title',
        'description',
        'image_alt',
    ];

    public $translationClass = SliderTranslation::class;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slider_type' => 'Тип слайдера',
            'file' => 'Файл',
            'status' => 'Статус',
            'sort_order' => 'Sort Order',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSliderTranslations()
    {
        return $this->hasMany(SliderTranslation::class, ['slider_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getUploadTypes()
    {
        return [
            self::SLIDER_TYPE_IMAGE => self::UPLOAD_FOLDER_IMAGE,
            self::SLIDER_TYPE_VIDEO => self::UPLOAD_FOLDER_VIDEO
        ];
    }
}
