<?php

namespace app\models\translations;

use Yii;
use app\models\Post;

/**
 * This is the model class for table "{{%post_translation}}".
 *
 * @property integer $post_id
 * @property string $title
 * @property string $content
 * @property string $language
 * @property string $image_alt
 * @property string $inner_image_alt
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 *
 * @property Post $post
 */
class PostTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_translation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['post_id'], 'integer'],
            [['content'], 'string'],
            [['meta_title','meta_keywords','meta_description'],'string','max' => 500],
            [['language', 'image_alt','inner_image_alt'], 'string', 'max' => 255],
            ['title', 'string', 'max' => 95],
            [['language','post_id'],'safe'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'title' => 'Заголовок',
            'content' => 'Контент',
            'language' => 'Language',
            'image_alt' => 'Alt прев\'ю',
            'inner_image_alt' => 'Alt внутрішнього зображення',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }
}
