<?php

namespace app\models;

use app\models\systemModels\TranslateActiveRecord;
use app\models\translations\PostTranslation;


/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property string $image
 * @property string $inner_image
 * @property integer $category_id
 * @property string $slug
 * @property integer $status
 * @property integer $count_views
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property PostTranslation[] $postTranslations
 * @property Category[] $category
 */
class Post extends TranslateActiveRecord
{
    const UPLOAD_FOLDER_IMAGE = 'post/prev';
    const UPLOAD_FOLDER_INNER_IMAGE = 'post/content';

    public $langForeignKey = 'post_id';

    public $translationAttributes = [
        'title',
        'content',
        'image_alt',
        'inner_image_alt',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public $translationClass = PostTranslation::class;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTranslations()
    {
        return $this->hasMany(PostTranslation::class, ['post_id' => 'id']);
    }


//    /**
//     * @return \yii\db\ActiveQuery
//     */
//    public function getCategory()
//    {
//        return $this->hasOne(Category::class, ['id' => 'category_id']);
//    }
}
