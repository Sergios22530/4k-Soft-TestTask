<?php

namespace app\models\forms;

use app\models\forms\traits\ContactFormTrait;
use yii\base\Model;

class ContactForm extends Model
{
    use ContactFormTrait;

    const MAX_DATE_MONTH_DIFF = 3; //3 month
    //
    /** SCENARIOS */
    const SCENARIO_FORM_1 = 'form_1';
    const SCENARIO_FORM_2 = 'form_2';

    public $company_name; //название компании
    public $post; //должность
    public $post_description; //описание должности
    public $salary; //размер заработной платы
    public $date_start; //дата начала
    public $date_end; //дата окончания
    public $created_at; //дата размещения
    public $name; //контактное имя
    public $email; //контактный email
    public $emptyField; //поле для проверки на бота

    public function scenarios()
    {
        return [
            self::SCENARIO_FORM_1 => ['company_name', 'post', 'post_description', 'salary', 'date_start', 'date_end', 'created_at', 'emptyField'],
            self::SCENARIO_FORM_2 => ['company_name', 'post', 'name', 'email', 'created_at', 'emptyField']
        ];
    }

    public function beforeValidate()
    {
        if (strlen($this->emptyField) > 0) { // check on bot (if field is empty - good else skip form validation)
            return false;
        }
        if ($this->getScenario() == self::SCENARIO_FORM_1) {
            $this->date_start = (!$this->date_start || strlen($this->date_start) == 0) ? date('d-m-Y') : $this->date_start;
            $this->validateStartEndDays();
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['company_name', 'post'], 'required'],
            ['email', 'required', 'on' => [self::SCENARIO_FORM_2]],
            ['date_end', 'required', 'on' => [self::SCENARIO_FORM_1]],
            [['company_name', 'post', 'name', 'email'], 'string', 'max' => 255],
            ['post_description', 'string', 'max' => 500],
            [['name', 'post'], 'match', 'pattern' => '/^[А-ЯіІёыЁЇїЄєЭэҐґa-zA-Z\'\s\-]+$/ui', 'message' => 'Поле {attribute} - не может бить числом.'],
            [['company_name', 'post', 'post_description', 'salary', 'date_start', 'date_end', 'created_at', 'name', 'email'], 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['salary', 'integer','max' => 999999],
            [['date_end', 'date_start', 'created_at'], 'string'],
            ['created_at', 'default', 'value' => function ($model, $attribute) {
                return date('d-m-Y');
            }, 'on' => [self::SCENARIO_FORM_1]],
            ['created_at', 'validateCreatedDate', 'on' => [self::SCENARIO_FORM_2]],
            ['emptyField', 'string']

        ];
    }

    public function attributeLabels()
    {
        return [
            'company_name' => 'Название Компании',
            'post' => 'Должность',
            'post_description' => 'Описание Должности',
            'salary' => 'Размер заработной платы',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'created_at' => 'Дата размещения',
            'name' => 'Контактное имя',
            'email' => 'Контактный email'
        ];
    }

    /**
     * @return string[]
     */
    public static function formTypes()
    {
        return [
            self::SCENARIO_FORM_1 => 'Форма1',
            self::SCENARIO_FORM_2 => 'Форма2',
        ];
    }
}