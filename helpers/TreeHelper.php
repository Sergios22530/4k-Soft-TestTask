<?php

namespace app\helpers;

use app\models\Tree;
use yii\base\InvalidArgumentException;
use yii\helpers\ArrayHelper;

class TreeHelper
{

    /**
     * @param array $attributes
     * @return bool
     */
    public static function filterAttributes(array $attributes)
    {
        $result = array_filter($attributes);
        if (empty($result)) {
            throw new InvalidArgumentException('Tree attributes must be set!');
        }

        return true;
    }

    /**
     *  Create node path for next node depth
     * @param Tree $parentNode
     * @param $childrenCount
     * @return string
     */
    public static function createNodePath(Tree $parentNode, $childrenCount)
    {
        $index = ($childrenCount == 0) ? 1 : $childrenCount + 1;
        return "{$parentNode->path}.$index";
    }

    /**
     * @param Tree | array $tree
     * @return array|string
     */
    public static function prepareTreeData($tree)
    {
        if (!$tree) return 'Data is empty!';
        return ArrayHelper::map($tree, 'id', function ($node) {
            /** @var $node Tree */
            $separator = '';
            $count = count(explode('.', $node->path));
            for ($i = 1; $i <= $count; $i++) {
                $separator .= '|';
            }

            return "{$separator}  $node->path  --- Parent Id:{$node->parent_id}, Position: {$node->position}, Level: {$node->level}";
        });
    }
}