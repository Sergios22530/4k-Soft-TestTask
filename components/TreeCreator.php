<?php

namespace app\components;

use app\helpers\ErrorHelper;
use app\models\forms\CreateTreeForm;
use app\models\Tree;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Class TreeCreator
 * @package app\commands
 *
 * @property integer | null $parentId
 * @property integer | null $position
 * @property CreateTreeForm $treeForm
 */
class TreeCreator
{
    public $parentId = null;
    public $position = null;
    private $treeForm;

    public function __construct($parentId, $position)
    {
        try {
            $this->setAttributes(['parentId' => $parentId, 'position' => $position]);//global attributes setter
        } catch (\Exception $e) {
        }

        $this->treeForm = new CreateTreeForm();//create tree validation form object
        if (!$this->validate()) {
            throw new InvalidConfigException(ErrorHelper::prepareErrors($this->treeForm->getErrors()));
        }
    }

    /**
     * @return bool
     */
    public function createNode()
    {
        return (new Tree())->create($this->parentId, $this->position);
    }

    /**
     * Validate TreeCreator data
     * @return bool
     */
    private function validate()
    {
        $this->treeForm->parentId = $this->parentId;
        $this->treeForm->position = $this->position;

        return $this->treeForm->validate();
    }

    /**
     * @param array $attributes
     * @return false
     * @throws \Exception
     */
    private function setAttributes($attributes = [])
    {
        if (empty($attributes)) return false;
        foreach (get_object_vars($this) as $attributeName => $attributeValue) {
            $this->{$attributeName} = ArrayHelper::getValue($attributes, $attributeName);
        }
    }
}