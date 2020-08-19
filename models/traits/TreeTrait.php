<?php

namespace app\models\traits;

use app\models\queries\TreeQuery;
use app\models\Tree;
use app\helpers\TreeHelper;

trait TreeTrait
{

    /**
     * This method get children nodes by depth
     * @param null $level
     * @return TreeQuery
     */
    public function childrens($level = null)
    {
        /** @var $this Tree */
        TreeHelper::filterAttributes($this->getAttributes());

        $childrens = $this::find()
            ->where('path LIKE "' . $this->preparePath($this) . '"')
            ->orderBy('path');
        if ($level) {
            $childrens->andWhere(['level' => (int)$level]);
        }

        return $childrens;
    }

    /**
     * @return mixed
     */
    public function parents()
    {
        TreeHelper::filterAttributes($this->getAttributes());
        $explodedPath = explode('.', $this->path);

        $condition = [];
        if ($explodedPath) {
            foreach ($explodedPath as $depth) {
                array_pop($explodedPath);
                if (empty($explodedPath)) break;
                $condition[] = 'path = "' . implode('.', $explodedPath) . '"';
            }
        }

        $parents = $this::find()
            ->where(implode(' OR ', $condition))
            ->andWhere(['position' => $this->position])
            ->orderBy('path');

        return $parents;
    }

    /**
     * @return mixed
     */
    public function getRootNode()
    {
        return self::findOne(self::ROOT_NODE_ID);
    }

    /**
     * Prepare path for search query
     * @param Tree $node
     * @return string
     */
    private function preparePath(Tree $node)
    {
        $defs = explode('.', $node->path);
        if (count($defs) >= self::MAX_NODE_DEPTH) {
            return $node->path;
        }

        return "$node->path.%";
    }
}