<?php

namespace app\components;

use app\helpers\TreeHelper;
use app\models\Tree;
use yii\base\InvalidCallException;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

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

    public function autocompleteTree($depth = Tree::MAX_NODE_DEPTH)
    {
        // TODO redevelop method!!!!!

        /** @var $rootNode Tree */
        $rootNode = $this->tree->getRootNode();
        if (!$rootNode) {
            throw new InvalidCallException('Root node must be create in database!!');
        }

        $nodes = [];

        for ($depthStep = 1; $depthStep <= Tree::MAX_NODE_DEPTH; $depthStep++) {
            foreach ($this->searchingPositions as $position) {
                for ($level = $rootNode->level; $level <= $depth; $level++) {
                    $children = $rootNode->childrens($level)->andWhere(['position' => $position, 'level' => $level]);
                    $childrenCount = (int)$children->count();
                    $nodes[$depthStep][$position][$level] = ['totalCount' => $childrenCount];
                }
            }
        }
        if (empty($nodes)) return false;

        VarDumper::dump($nodes, 10, true);
        die();
//        (new TreeCreator(1, 2))->createNode();

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