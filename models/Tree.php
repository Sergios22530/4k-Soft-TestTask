<?php

namespace app\models;

use app\helpers\TreeHelper;
use app\models\queries\TreeQuery;
use app\models\traits\TreeTrait;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%tree}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property int $position
 * @property string $path
 * @property int $level
 */
class Tree extends ActiveRecord
{
    use TreeTrait;

    const MAX_NODE_DEPTH = 5;
    const ROOT_NODE_ID = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tree}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'position', 'path', 'level'], 'required'],
            [['parent_id', 'position', 'level'], 'integer'],
            [['path'], 'string', 'max' => 12288],
            ['path', 'filter', 'filter' => 'trim']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'position' => 'Position',
            'path' => 'Path',
            'level' => 'Level',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TreeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TreeQuery(get_called_class());
    }

    /**
     * This method create Node
     * @param $parentId
     * @param $position
     * @return bool
     */
    public function create($parentId, $position)
    {
        $parent = self::findOne($parentId);
        if (!$parent) {
            return false; // if parent not found break creating
        }
        $nextNodeLevel = $parent->level + 1;
        $childrenCount = (int)$parent->childrens($nextNodeLevel)->andWhere(['position' => $position])->count(); // detect children count by depth

        if ($childrenCount >= self::MAX_NODE_DEPTH || $nextNodeLevel > self::MAX_NODE_DEPTH) {
            return false; // if childrens > 5 or next node level > 5 - break creating
        }
        $this->setAttributes([
            'parent_id' => $parentId,
            'position' => $position,
            'level' => $nextNodeLevel,
            'path' => TreeHelper::createNodePath($parent, $childrenCount)
        ]);


        return $this->save();
    }

    /**
     * @return array
     */
    public static function getTree()
    {
        $tree = self::find()
            ->where('path LIKE "1%"')
            ->orderBy('path')
            ->all();

        return TreeHelper::prepareTreeData($tree);
    }

}
