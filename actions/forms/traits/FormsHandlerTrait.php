<?php

namespace app\actions\forms\traits;

use app\models\Form2;
use yii\widgets\ActiveForm;
use app\models\forms\ContactForm;
use app\models\Form1;

trait FormsHandlerTrait
{
    public function poundForm1()
    {
        $formData = $this->_post['ContactForm'];
        $form = new ContactForm();
        $form->scenario = ContactForm::SCENARIO_FORM_1;

        if ($form->load($this->_post) && $form->validate()) {
            $form1 = new Form1();
            $form1->attributes = $formData;

            if ($status = $form1->save()) {
                $form1->convertDates();
                $this->sendEmail(
                    $form,
                    array_filter($form1->toArray(['company_name', 'post', 'post_description', 'salary', 'date_start', 'date_end', 'created_at']))
                );
            }
            $this->_response->data['success'] = $status;
        } else {
            $this->_response->data['success'] = false;
            $this->_response->data['errors'] = ActiveForm::validate($form);
        }
    }

    public function poundForm2()
    {
        $formData = $this->_post['ContactForm'];
        $form = new ContactForm();
        $form->scenario = ContactForm::SCENARIO_FORM_2;

        if ($form->load($this->_post) && $form->validate()) {
            $form2 = new Form2();
            $form2->attributes = $formData;

            if ($status = $form2->save()) {
                $form2->convertDates();
                $this->sendEmail(
                    $form,
                    array_filter($form2->toArray(['company_name', 'post', 'name', 'email', 'created_at']))
                );
            }
            $this->_response->data['success'] = $status;
        } else {
            $this->_response->data['success'] = false;
            $this->_response->data['errors'] = ActiveForm::validate($form);
        }
    }
}