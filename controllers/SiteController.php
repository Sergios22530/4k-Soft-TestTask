<?php

namespace app\controllers;

use app\models\Tree;
use yii\web\Controller;
use app\components\TreeControl;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
//        (new TreeCreator(1, 1))->createNode(); //create node

//            $treeControl = new TreeControl();
//        $treeControl->getChildNodes(182); //- get node children
//        $treeControl->getParentNodes(134); // - get node parents

//        (new TreeControl())->autocompleteTree(); //TODO redevelop method!!!!!
        return $this->render('index', ['tree' => Tree::getTree()]);
    }
}
