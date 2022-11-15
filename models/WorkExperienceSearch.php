<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkExperience;

/**
 * WorkExperienceSearch represents the model behind the search form of `app\models\WorkExperience`.
 */
class WorkExperienceSearch extends WorkExperience
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cv_id', 'hours'], 'integer'],
            [['company_name', 'job_title', 'from_date', 'to_date', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = WorkExperience::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cv_id' => $this->cv_id,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'hours' => $this->hours,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
