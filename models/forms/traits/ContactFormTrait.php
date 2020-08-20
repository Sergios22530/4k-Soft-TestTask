<?php

namespace app\models\forms\traits;

use DateTime;

trait ContactFormTrait
{
    /**
     * @return bool
     * @throws \Exception
     */
    public function validateStartEndDays()
    {
        if (!$this->date_start || !$this->date_end) return true;
        $dateStart = new DateTime($this->date_start);
        $dateEnd = new DateTime($this->date_end);
        $interval = $dateStart->diff($dateEnd);

        if ($interval->m > self::MAX_DATE_MONTH_DIFF) {
            $this->addErrors([
                'date_start' => 'Минимальный период даты начала и даты окончания - 3 месяца',
                'date_end' => 'Минимальный период даты начала и даты окончания - 3 месяца'
            ]);
            return false;
        }

        return true;
    }

    /**
     * @param $attribute
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public function validateCreatedDate($attribute, $params)
    {
        $dateStart = new DateTime($this->{$attribute});
        $dateNov = new DateTime();
        if ($dateStart <= $dateNov) {
            $this->addError($attribute, 'Дата размещения должна быть больше текущей');
            return false;
        }

        return true;
    }
}