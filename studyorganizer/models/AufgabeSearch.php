<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aufgabe;

/**
 * AufgabeSearch represents the model behind the search form of `app\models\Aufgabe`.
 */
class AufgabeSearch extends Aufgabe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AufgabeID', 'Finished', 'UserID', 'FachID'], 'integer'],
            [['Titel', 'Beschreibung', 'DueDate'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Aufgabe::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'AufgabeID' => $this->AufgabeID,
            'DueDate' => $this->DueDate,
            'Finished' => $this->Finished,
            'UserID' => $this->UserID,
            'FachID' => $this->FachID,
        ]);

        $query->andFilterWhere(['like', 'Titel', $this->Titel])
            ->andFilterWhere(['like', 'Beschreibung', $this->Beschreibung]);

        return $dataProvider;
    }
}
