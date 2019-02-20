<?php

namespace app\modules\admin\models\search;

use app\models\translations\SourceMessageTranslation;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\systemModels\SourceMessage;
use yii\helpers\ArrayHelper;

/**
 * SourceMessageSearch represents the model behind the search form about `app\models\SourceMessage`.
 */
class SourceMessageSearch extends SourceMessage
{
    public $translation;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['category', 'message'], 'safe'],
            ['translation', 'string'],
            [
                ['translation'],
                'filter',
                'filter' => 'trim'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SourceMessage::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $request = Yii::$app->request->get('SourceMessageSearch');

        if ($request && ArrayHelper::keyExists('translation', $request) && strlen($request['translation']) !== 0) {
            $translation = SourceMessageTranslation::find()
                ->select('id')
                ->where(['like', 'translation', $request['translation']])
                ->asArray()
                ->all();

            $query->where(['in', 'id', ArrayHelper::map($translation, 'id', 'id')]);
        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
