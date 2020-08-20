<?php

namespace app\actions\forms;

use app\models\forms\ContactForm;
use app\actions\forms\traits\FormsHandlerTrait;
use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class FormsHandlerAction
 * @package app\actions\forms
 *
 * @property string $formProcess
 */
class FormsHandlerAction extends Action
{
    use FormsHandlerTrait;

    const LEAVE_REQUEST_PROCESS = 0;

    public $formProcess = null;

    private $_post = null;
    private $_response = null;

    /**
     * Init form request
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     */
    public function init()
    {
        if (!Yii::$app->request->isPost) {
            throw new NotFoundHttpException();
        }
        if (!$this->formProcess || !ArrayHelper::keyExists($this->formProcess, ContactForm::formTypes())) {
            throw new InvalidConfigException('Invalid formProcess value!');
        }
        $this->_post = Yii::$app->request->post();

        if ($this->checkOnBot()) throw new NotFoundHttpException();

        $this->_response = Yii::$app->getResponse();
        $this->_response->format = Response::FORMAT_JSON;
    }

    /**
     * This method init forms handlers by process type
     * @return null
     * @throws NotFoundHttpException
     */
    public function run()
    {
        if (\Yii::$app->getRequest()->getIsAjax()) {
            switch ($this->formProcess) {
                case ContactForm::SCENARIO_FORM_1:
                    $this->poundForm1();
                    return $this->_response;
                case ContactForm::SCENARIO_FORM_2:
                    $this->poundForm2();
                    return $this->_response;
                default:
                    throw new NotFoundHttpException();
            }
        }
        throw new NotFoundHttpException();
    }

    /**
     * This method send email message by custom params
     * @param $attributes
     * @param ContactForm $model
     * @return bool
     */
    private function sendEmail($model, $attributes)
    {
        $mailer = Yii::$app->mailer;
        $mailer->setTransport([
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => Yii::$app->params['support']['email'],
            'password' => Yii::$app->params['support']['password'],
            'port' => '587',
            'encryption' => 'tls',
        ]);
        $message = $mailer->compose(['html' => 'form-template-mail'], ['model' => $model, 'attributes' => $attributes]);
        $message->setFrom(Yii::$app->params['support']['email'])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setReplyTo(Yii::$app->params['support']['email'])
            ->setSubject('Новое сообщение')
            ->setCharset('utf-8');

        return $message->send();
    }

    /**
     * This method check post data on bot by system form field ('emptyField')
     * @return bool
     */
    protected function checkOnBot()
    {
        if (strlen($this->_post['ContactForm']['emptyField']) == 0) {
            unset($this->_post['ContactForm']['emptyField']);
            return false;
        }

        return true;
    }

}