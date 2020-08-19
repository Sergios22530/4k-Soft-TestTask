<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Class CreateTreeForm
 * @package app\models\forms
 *
 * @property integer $parentId
 * @property integer $position
 */
class CreateTreeForm extends Model
{
    public $parentId;
    public $position;

    public function rules()
    {
        return [
            [['parentId', 'position'], 'required'],
            [['parentId', 'position'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'parentId' => 'Parent Id',
            'position' => 'Position',
        ];
    }
}