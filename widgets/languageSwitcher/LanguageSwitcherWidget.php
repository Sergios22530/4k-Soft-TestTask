<?php

namespace app\widgets\languageSwitcher;

use app\models\systemModels\Language;
use yii\base\Widget;
use Yii;

class LanguageSwitcherWidget extends Widget
{
    public function run()
    {
        $route = Yii::$app->controller->route;
        $params = $_GET;
        array_unshift($params, '/' . $route);
        $items = [];
        $languages = Language::getLanguages();
        $defaultLanguage = '';
        foreach ($languages as $language) {
            /* @var $language Language */
            if ($language['default']) {
                $defaultLanguage = $language['prefix'];
            }
            $params['language'] = $language['prefix'];
            $items[] = [
                'label' => $language['name'],
                'url' => $params,
                'options' => []
            ];
        }

        return $this->render('block', ['items' => $items,
            'defaultLanguage' => $defaultLanguage,
            'currentName' => Language::find()->select(['name'])->where(['local' => Yii::$app->language])->one()['name']
        ]);
    }
}