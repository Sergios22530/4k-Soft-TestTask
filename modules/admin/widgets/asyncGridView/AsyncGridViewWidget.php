<?php

namespace app\modules\admin\widgets\asyncGridView;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use app\modules\admin\widgets\asyncGridView\assets\AsyncGridViewAsset;

class AsyncGridViewWidget extends Widget
{
    const INDEX_PAGE = 'index';
    const FORM_PAGE = 'form';

    public $page = self::INDEX_PAGE;
    public $pjaxContainerId = null;
    public $indexUrl = null;
    public $model = false;

    public function init()
    {
        foreach (get_object_vars($this) as $optionName => $optionValue) {
            if(is_null($optionValue)){
                throw new InvalidConfigException("Parameter {$optionName} can't be null");
            }
        }
        $view = $this->getView();
        AsyncGridViewAsset::register($view);

        parent::init();
    }

    public function run()
    {
//        $this->registerConfig();
        return $this->render($this->page,[
            'pjaxContainerId' => $this->pjaxContainerId,
            'indexUrl' => $this->indexUrl,
            'model' => $this->model
        ]);
    }


    /**
     * This method register global js variable with config params
     */
    private function registerConfig()
    {
        $config = [
            'gridViewId' => $this->gridViewId,
            'indexUrl' => $this->indexUrl,
            'page' => $this->page,
            'isNewRecord' => $this->isNewRecord,
            'const' => [
                'indexPage' => self::INDEX_PAGE,
                'formPage' => self::FORM_PAGE
            ]
        ];

        $this->view->registerJsVar('asyncGridConfig', $config);
    }
}