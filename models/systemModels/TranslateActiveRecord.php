<?php

namespace app\models\systemModels;

use yii\db\ActiveRecord;
use creocoder\translateable\TranslateableBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property string $translationClass
 * @property string $langForeignKey
 * @property array $translationAttributes
 * @property array $exceptRoutes
 *
 *
 * @mixin TranslateableBehavior
 */
class TranslateActiveRecord extends ActiveRecord
{
    public $langForeignKey;

    public $translationAttributes;

    public $translationClass;


    /**
     * Returns a list of behaviors that this component should behave as.
     * @return array
     */
    public function behaviors()
    {
        return [
            'translateable' => [
                'class' => TranslateableBehavior::class,
                'translationAttributes' => $this->translationAttributes,
                'translationRelation' => 'translations',
                'translationLanguageAttribute' => 'language',
            ],
        ];
    }

    /**
     * Declares which DB operations should be performed within a transaction in different scenarios.
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->initTranslationAction($insert);

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * This method init translation action for create or update translation attributes
     * @param $isNewRecord
     */
    public function initTranslationAction($isNewRecord)
    {
        if ($isNewRecord) {
            return $this->createTranslations();
        } else {
            return $this->updateTranslations();
        }
    }

    /**
     * Create translations (for Create Action)
     */
    public function createTranslations()
    {
        /** Saving translation attributes */
        $class = (new \ReflectionClass($this->translationClass))->getShortName();
        foreach (\Yii::$app->request->post($class, []) as $language => $data) {
            $translationModel = Yii::createObject(['class' => $this->translationClass]);
            foreach ($this->translationAttributes as $attributeName) {
                if (isset($data[$attributeName])) {
                    $translationModel->$attributeName = $data[$attributeName];
                }
            }
            $translationModel->language = $language;
            $translationModel->{$this->langForeignKey} = $this->id;
            $translationModel->save();
        }
        /** End saving translation attributes */
    }

    /**
     * Update translations (for Update Action)
     */
    public function updateTranslations()
    {
        /** Update translation attributes */
        $translationAttributes = [];
        $class = (new \ReflectionClass($this->translationClass))->getShortName();
        foreach (\Yii::$app->request->post($class, []) as $language => $data) {

            foreach ($this->translationAttributes as $attributeName) {
                if (isset($data[$attributeName])) {
                    $translationAttributes[$attributeName] = $data[$attributeName];
                }
            }
            $translationModel = Yii::createObject(['class' => $this->translationClass]);

            if ($this->checkOnExistNewLanguage($translationModel, $language)) { // if user add new language in admin panel
                Yii::$app->db->createCommand()
                    ->update(
                        $translationModel::tableName(),
                        $translationAttributes,
                        [$this->langForeignKey => $this->id, 'language' => $language]
                    )
                    ->execute();
            } else {
                $translationModel->attributes = ArrayHelper::merge($translationAttributes, [
                    $this->langForeignKey => $this->id,
                    'language' => $language
                ]);

                return $translationModel->save();
            }
            $translationAttributes = [];
        }

        /** End update translation attributes */
    }

    /**
     * This method find new language in related translated table
     * @param $translationModel
     * @param $language
     * @return bool
     */
    private function checkOnExistNewLanguage($translationModel, $language)
    {
        /* @var $translationModel ActiveRecord */
        return $translationModel::find()->where(['language' => $language, $this->langForeignKey => $this->id])->exists();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(call_user_func([$this->translationClass, 'className']), [$this->langForeignKey => 'id']);
    }

}