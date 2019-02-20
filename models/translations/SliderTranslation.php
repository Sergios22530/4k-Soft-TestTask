<?php

namespace app\models\translations;

use Yii;
use app\models\Slider;


/**
 * This is the model class for table "{{%slider_translation}}".
 *
 * @property int $slider_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property string $image_alt
 *
 * @property Slider $slider
 */
class SliderTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider_translation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slider_id', 'language'], 'required'],
            [['slider_id'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['title', 'description', 'image_alt'], 'string', 'max' => 255],
            [['slider_id', 'language'], 'unique', 'targetAttribute' => ['slider_id', 'language']],
            [['slider_id'], 'exist', 'skipOnError' => true, 'targetClass' => Slider::class, 'targetAttribute' => ['slider_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'slider_id' => 'Slider ID',
            'language' => 'Language',
            'title' => 'Заголовок',
            'description' => 'Опис',
            'image_alt' => 'Alt зображення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlider()
    {
        return $this->hasOne(Slider::class, ['id' => 'slider_id']);
    }
}
