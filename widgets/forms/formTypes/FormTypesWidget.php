<?php

namespace app\widgets\forms\formTypes;

use app\models\forms\ContactForm;
use yii\base\Widget;

/**
 * Class ContactFormWidget
 * @package app\widgets\contactForm
 *
 * @property ContactForm $model
 * @property string $form
 */
class FormTypesWidget extends Widget
{
    public function run()
    {
        return $this->render('block');
    }
}