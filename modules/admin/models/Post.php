<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 */
class Post extends \app\models\Post
{
    public $tempUploadImage; //temp variable for upload image
    public $tempUploadInnerImage; //temp variable for upload inner image

    const PREVIEW_RESIZE_WIDTH = 420;
    const PREVIEW_RESIZE_HEIGHT = 350;
    const INNER_IMAGE_RESIZE_WIDTH = 960;
    const INNER_IMAGE_RESIZE_HEIGHT = 500;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug','created_at'], 'required'],
            ['category_id', 'default', 'value' =>null],
            ['count_views', 'default', 'value' => 0],
            ['count_views', 'integer', 'min' => 0],
            [['category_id', 'status', 'updated_at'], 'integer'],
            ['slug', 'string', 'max' => 255],
            [['image', 'tempUploadImage', 'inner_image', 'tempUploadInnerImage'], 'safe']
        ];
    }


    public function beforeSave($insert)
    {
        $this->created_at = Yii::$app->formatter->asTimestamp($this->created_at);
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->created_at = Yii::$app->getFormatter()->asDate($this->created_at, 'yyyy-M-dd hh:mm');
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Прев\'ю',
            'inner_image' => 'Внутрішне зображення',
            'category_id' => 'Категорія',
            'slug' => 'Url',
            'status' => 'Статус',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
            'count_views' => 'Кількість переглядів'
        ];
    }

}
