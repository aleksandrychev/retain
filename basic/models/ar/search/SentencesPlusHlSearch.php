<?php

namespace app\models\ar\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\SentencesPlusHl;

/**
 * SentencesPlusHlSearch represents the model behind the search form about `app\models\ar\SentencesPlusHl`.
 */
class SentencesPlusHlSearch extends SentencesPlusHl
{

    public $projectName;
    public $reference;
    public $docName;
    public $keywordString;
    public $conceptString;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doc_id', 'user_id', 'project_id', 'page_number', 'line_number', 'paragraph_number'], 'integer'],
            [['note','entity', 'manual_date', 'positions', 'sent_hl', 'meta_data','projectName','docName','keywordString','conceptString','reference'], 'safe'],
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
        $query = SentencesPlusHl::find()->groupBy('id');


        $query->where('documents.title LIKE "%' . $this->docName . '%"');
        $query->joinWith(['project' => function ($q) {
            $q->where('projects.title LIKE "%' . $this->projectName . '%"');
        }]);

        $query->joinWith(['keywords' => function ($q) {
            $q->where('extracted_keywords.text LIKE "%' . $this->keywordString . '%"');
        }]);

        $query->joinWith(['concepts' => function ($q) {
            $q->where('extracted_concepts.text LIKE "%' . $this->conceptString . '%"');
        }]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['docName'] = [
            'asc' => ['documents.title' => SORT_ASC],
            'desc' => ['documents.title' => SORT_DESC],
            'label' => 'Source Document'
        ];

        $dataProvider->sort->attributes['projectName'] = [
            'asc' => ['projects.title' => SORT_ASC],
            'desc' => ['projects.title' => SORT_DESC],
            'label' => 'Project Name'
        ];

        $dataProvider->sort->attributes['keywordString'] = [
            'asc' => ['extracted_concepts.text' => SORT_ASC],
            'desc' => ['extracted_concepts.text' => SORT_DESC],
            'label' => 'Document Keywords'
        ];

        $dataProvider->sort->attributes['conceptString'] = [
            'asc' => ['extracted_concepts.text' => SORT_ASC],
            'desc' => ['extracted_concepts.text' => SORT_DESC],
            'label' => 'Document Concepts'
        ];



        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doc_id' => $this->doc_id,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'page_number' => $this->page_number,
            'line_number' => $this->line_number,
            'paragraph_number' => $this->paragraph_number,
            'entity' => $this->entity,
            'documents.title' => $this->docName,
        ]);

        $query
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'manual_date', $this->manual_date])
            ->andFilterWhere(['like', 'positions', $this->positions])
            ->andFilterWhere(['like', 'sent_hl', $this->sent_hl])
            ->andFilterWhere(['like', 'meta_data', $this->meta_data])
            ->orFilterWhere(['like', 'entity', $this->entity])
            ->orFilterWhere(['like', 'documents.title',  $this->docName  ])
            ->andFilterWhere(['like', 'page_number',  $this->reference  ])
            ->andFilterWhere(['like', 'line_number',  $this->reference  ])
            ->andFilterWhere(['like', 'paragraph_number',  $this->reference  ]);

        return $dataProvider;
    }
}
