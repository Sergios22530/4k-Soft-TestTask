<?php

namespace app\components;

use app\helpers\TreeHelper;
use app\models\Tree;
use yii\base\InvalidCallException;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class TreeControl
 * @package app\components
 *
 * @property Tree $tree
 */
class TreeControl
{
    private $tree;
    private $searchingPositions = [1, 2];

    public function __construct()
    {
        $this->tree = new Tree();
    }

    /**
     * @param int $depth
     * @throws InvalidConfigException
     */
    public function autoCompleteTree($depth = Tree::MAX_NODE_DEPTH)
    {
//        ini_set("memory_limit", "512M"); // uncomment if script is down
        /** @var $rootNode Tree */
        $rootNode = $this->tree->getRootNode();
        if (!$rootNode) {
            throw new InvalidCallException('Root node must be create in database!!');
        }

        Tree::deleteAll(['!=', 'id', $rootNode->id]);

        foreach ($this->searchingPositions as $nodePosition) {
            for ($levelStep = 1; $levelStep <= Tree::MAX_NODE_DEPTH; $levelStep++) {
                $nodes = Tree::find()->where(['level' => $levelStep, 'position' => $nodePosition])->all();
                if ($nodes) {
                    $this->createBranch($nodes);
                } else {
                    if (!$this->createBranchRecursive($nodePosition, $levelStep)) continue;
                }
            }
        }

        return Tree::getTree();
    }

    /**
     * @param $nodePosition
     * @param $levelStep
     * @return false
     * @throws InvalidConfigException
     */
    private function createBranchRecursive($nodePosition, $levelStep)
    {
        $parents = Tree::find()->where(['level' => $levelStep - 1])->all();
        if ($nodePosition == 2 && $levelStep == 1) {
            $startNode = new Tree();
            $startNode->setAttributes([ // create first root node for position - 2, step - 1
                'parent_id' => 1,
                'position' => 2,
                'path' => '1',
                'level' => 1,
                'id' => 1
            ]);

            $this->createBranch([0 => $startNode]);
            $parents = Tree::find()->where(['position' => $nodePosition])->all();
        }

        if (!$parents) return false;
        foreach ($parents as $parent) {
            $childrenQuery = $parent->childrens($levelStep);
            $childrenCount = $childrenQuery->count();
            if ((int)$childrenCount == Tree::MAX_NODE_DEPTH) continue;
            for ($i = 1; $i <= Tree::MAX_NODE_DEPTH - $childrenCount; $i++) {
                (new TreeCreator($parent->id, $nodePosition))->createNode();
            }
        }

        if ($levelStep + 1 < Tree::MAX_NODE_DEPTH) {
            for ($i = 1; $i <= Tree::MAX_NODE_DEPTH; $i++) {
                $this->createBranchRecursive($nodePosition, $levelStep + 1);
            }
        }
    }

    /**
     * @param $nodes
     * @return bool
     * @throws InvalidConfigException
     */
    private function createBranch($nodes)
    {
        if (is_array($nodes) && count($nodes) >= Tree::MAX_NODE_DEPTH) return true;
        /** @var $node Tree */
        $node = $nodes[0];
        for ($i = 1; $i <= Tree::MAX_NODE_DEPTH - count($nodes); $i++) {
            (new TreeCreator($node->parent_id, $node->position))->createNode();
        }

        return true;
    }

    /**
     * Get node children
     * @param $nodeId
     * @return array|string|null
     */
    public function getChildNodes($nodeId)
    {
        $node = $this->tree->findOne($nodeId);
        if (!$node) return null;

        return TreeHelper::prepareTreeData($node->childrens()->all());
    }

    /**
     * Get node parents
     * @param $nodeId
     * @return array|string|null
     */
    public function getParentNodes($nodeId)
    {
        $node = $this->tree->findOne($nodeId);
        if (!$node) return null;

        $parents = $node->parents()->all();
        if ($root = $this->tree->getRootNode()) {
            $parents = ArrayHelper::merge([0 => $this->tree->getRootNode()], $parents);
        }

        return TreeHelper::prepareTreeData($parents);
    }

}