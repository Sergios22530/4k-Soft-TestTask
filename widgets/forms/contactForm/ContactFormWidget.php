<?php

namespace app\widgets\forms\contactForm;

use app\models\forms\ContactForm;
use yii\base\Widget;

/**
 * Class ContactFormWidget
 * @package app\widgets\forms\contactForm
 *
 * @property string $formView
 * @property ContactForm $model
 */
class ContactFormWidget extends Widget
{
    const DEFAULT_VIEW = 'description';

    public $formView = self::DEFAULT_VIEW;
    private $model;

    public function beforeRun()
    {
        $this->model = new ContactForm();
        if ($this->formView != self::DEFAULT_VIEW) {
            $this->model->scenario = $this->formView;
        }

        return parent::beforeRun();
    }

    public function run()
    {
        return $this->render($this->formView, ['model' => $this->model]);
    }
}