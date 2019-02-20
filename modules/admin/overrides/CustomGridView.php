<?php

namespace app\modules\admin\overrides;

use Yii;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\grid\GridViewAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;


class CustomGridView extends GridView
{
    public $customGridViewId = 'grid-view-id';
    public $options = ['class' => 'table-responsive'];
    public $useCustomColumns = true;

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->options['id'] = $this->customGridViewId;
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        GridViewAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiGridView($options);");
        parent::run();
    }

    /**
     * Creates column objects and initializes them.
     */
    protected function initColumns()
    {
        if ($this->useCustomColumns) $this->prepareCustomColumns();
        if (empty($this->columns)) {
            $this->guessColumns();
        }
        foreach ($this->columns as $i => $column) {
            if (is_string($column)) {
                $column = $this->createDataColumn($column);
            } else {
                $column = Yii::createObject(array_merge([
                    'class' => $this->dataColumnClass ?: DataColumn::className(),
                    'grid' => $this,
                ], $column));
            }
            if (!$column->visible) {
                unset($this->columns[$i]);
                continue;
            }
            $this->columns[$i] = $column;
        }
    }

    /**
     * This method add custom options to basic grid view widget
     */
    private function prepareCustomColumns()
    {

        $customColumns = [
            count($this->columns) => [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        $options = [
                            'class' => 'modalButton',
                            'value' => Url::to([Yii::$app->controller->id . '/update', 'id' => $model->id]),
                        ];
                        $url = "#";
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'delete' => function ($url, $model) {
                        $options = [
                            'class' => 'delete-btn',
                            'action' => Url::to([Yii::$app->controller->id . '/delete', 'id' => $model->id]),
                            'data-method' => "post",
                            'data-id' => $model->id
                        ];
                        $url = 'javascript: void(0)';
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    },
                ]
            ]
        ];

        $this->columns = ArrayHelper::merge($this->columns, $customColumns);

//        if(!empty($this->exemptedColumnOptions)){
//            foreach ($this->columns as $key => $value) {
//                if (isset($value['class']) && ArrayHelper::isIn($value['class'], $this->exemptedColumnOptions)) {
//                    unset($this->columns[$key]);
//                }
//            }
//        }
    }

}