<?php

namespace app\modules\admin\models;

use app\modules\admin\helpers\FileUploadHelper;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%slider}}".
 */
class Slider extends \app\models\Slider
{
    public $tempUploadFile; //temp variable for upload image
    public $tempUploadVideo; //temp variable for upload image

    public $videoFile;
    public $imageFile;

    const IMAGE_RESIZE_HEIGHT = 1000;
    const IMAGE_RESIZE_WIDTH = 1920;

    public function behaviors()
    {
        $parents = parent::behaviors();

        return array_merge($parents, [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ],
            'sortable' => [
                'class' => \kotchuprik\sortable\behaviors\Sortable::class,
                'query' => self::find(),
                'orderAttribute' => 'sort_order'
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slider_type'], 'required'],
            [['slider_type', 'status', 'created_at', 'updated_at', 'sort_order'], 'integer'],
            ['sort_order', 'default', 'value' => 0],
            [['file', 'tempUploadFile', 'tempUploadVideo'], 'safe'],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->slider_type == self::SLIDER_TYPE_IMAGE && strlen($this->videoFile) != 0) {
            FileUploadHelper::unlinkFile(self::UPLOAD_FOLDER_VIDEO, $this->videoFile);
        }

        if ($this->slider_type == self::SLIDER_TYPE_VIDEO && strlen($this->imageFile) != 0) {
            FileUploadHelper::unlinkFile(self::UPLOAD_FOLDER_IMAGE, $this->imageFile);
        }

        $this->saveData();
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        if ($this->slider_type == self::SLIDER_TYPE_IMAGE) {
            $this->imageFile = $this->file;
        }

        if ($this->slider_type == self::SLIDER_TYPE_VIDEO) {
            $this->videoFile = $this->file;
        }
        parent::afterFind();
    }

    public function beforeDelete()
    {
        if ($this->slider_type == self::SLIDER_TYPE_IMAGE && FileUploadHelper::fileExist(self::UPLOAD_FOLDER_IMAGE, $this->file)) {
            FileUploadHelper::unlinkFile(self::UPLOAD_FOLDER_IMAGE, $this->file);
        }

        if ($this->slider_type == self::SLIDER_TYPE_VIDEO && FileUploadHelper::fileExist(self::UPLOAD_FOLDER_VIDEO, $this->file)) {
            FileUploadHelper::unlinkFile(self::UPLOAD_FOLDER_VIDEO, $this->file);
        }

        return parent::beforeDelete();
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'videoFile' => 'Відеофайл',
            'imageFile' => 'Зображення',

        ]);
    }

    /**
     * This method generate slider types (slider categories)
     * @return array
     */
    public static function sliderTypes()
    {
        return [
            self::SLIDER_TYPE_IMAGE => 'Зображення',
            self::SLIDER_TYPE_VIDEO => 'Відео'
        ];
    }

    /**
     * This method save files by slider types
     */
    private function saveData()
    {
        $post = Yii::$app->request->post('Slider');
        switch ($this->slider_type) {
            case self::SLIDER_TYPE_IMAGE:
                $attributeValue = ArrayHelper::getValue($post, 'imageFile');
                $this->file = (strlen($attributeValue) != 0) ? $attributeValue : null;
                break;
            case self::SLIDER_TYPE_VIDEO:
                $attributeValue = ArrayHelper::getValue($post, 'videoFile');
                $this->file = (strlen($attributeValue) != 0) ? $attributeValue : null;
                break;
            default:
                break;
        }
    }

    /**
     * Return array paths by upload file type
     * @return array
     */
    public static function uploadedPaths()
    {
        return [
            self::SLIDER_TYPE_IMAGE => self::UPLOAD_FOLDER_IMAGE,
            self::SLIDER_TYPE_VIDEO => self::UPLOAD_FOLDER_VIDEO
        ];
    }
}
