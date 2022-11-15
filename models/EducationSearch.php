<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Education;

/**
 * EducationSearch represents the model behind the search form of `app\models\Education`.
 */
class EducationSearch extends Education
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cv_id'], 'integer'],
            [['facility_name', 'education', 'start_date', 'end_date', 'description'], 'safe'],
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
        $query = Education::find();

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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'facility_name', $this->facility_name])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
