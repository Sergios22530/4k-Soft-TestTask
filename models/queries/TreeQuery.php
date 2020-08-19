<?php

namespace app\models\queries;


/**
 * This is the ActiveQuery class for [[\app\models\Tree]].
 *
 * @see \app\models\Tree
 */
class TreeQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return \app\models\Tree[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Tree|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
