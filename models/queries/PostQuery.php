<?php

namespace app\models\queries;

use app\helpers\Status;
use Yii;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;


class PostQuery extends ActiveQuery
{
    /**
     * Get active status categories
     * @return PostQuery
     */
    public function active()
    {
        return $this->where(['status' => Status::STATUS_ACTIVE]);
    }

    /**
     * Ger post by category id
     * @param $categoryId
     * @return PostQuery
     */
    public function byCategoryId($categoryId)
    {
        return $this->andWhere(['id' => $categoryId]);
    }

    /**
     * This method get post by id
     * @param null $postId
     * @return PostQuery
     * @throws NotFoundHttpException
     */
    public function byId($postId = null)
    {
        if (!$postId) {
            throw new NotFoundHttpException();
        }
        return $this->andWhere(['id' => $postId]);
    }

    /**
     * Sort posts by custom params
     * @param string $field
     * @param int $sortFlag
     * @return mixed
     */
    public function sortOrder($field = 'created_at', $sortFlag = SORT_DESC)
    {
        return $this->orderBy([$field => $sortFlag]);
    }

    /**
     * Get post translations by custom params
     * @param array $selectedFields
     * @return PostQuery
     */
    public function withPostTranslations($selectedFields = [])
    {
        return $this->with(['postTranslations' => function ($query) use ($selectedFields) {
            /** @var $query object */
            if (!empty($selectedFields)) {
                $query->select(array_values($selectedFields));
            }
            $query->where(['language' => Yii::$app->language])->asArray()->all();

        }]);
    }

    /**
     * Get post handlers by custom params
     * @param array $selectedFields
     * @return PostQuery
     */
    public function withHandler($selectedFields = [])
    {
        return $this->with(['handler' => function ($query) use ($selectedFields) {
            /** @var $query object */
            if (!empty($selectedFields)) {
                $query->select(array_values($selectedFields));
            }
            $query->asArray()->all();
        }]);
    }

    /**
     * Get post handlers by custom params
     * @param array $selectedFields
     * @return PostQuery
     */
    public function withGraphicPostContent($selectedFields = [])
    {
        return $this->with(['graphicPostContent' => function ($query) use ($selectedFields) {
            /** @var $query ActiveQuery */
            if (!empty($selectedFields)) {
                $query->select(array_values($selectedFields));
            }
            $query->where(['status' => Status::STATUS_ACTIVE])->asArray()->all();
        }]);
    }
}