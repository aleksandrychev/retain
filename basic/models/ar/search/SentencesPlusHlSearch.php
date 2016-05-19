<?php

namespace app\models\ar\search;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ar\SentencesPlusHl;
use yii\db\Expression;
use yii\sphinx\Query;


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
    public $searchText;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'doc_id',
                    'user_id',
                    'project_id',
                    'page_number',
                    'line_number',
                    'paragraph_number',
                    'tag_type',
                    'send_to_final_report'
                ],
                'integer'
            ],
            [
                [
                    'note',
                    'entity',
                    'entity_type',
                    'manual_date',
                    'positions',
                    'sent_hl',
                    'meta_data',
                    'projectName',
                    'docName',
                    'keywordString',
                    'conceptString',
                    'reference',
                    'searchText',
                ],
                'safe'
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
        $this->load($params);
        $query = SentencesPlusHl::find()->where(['user_id' => Yii::$app->user->id])->andWhere('entity_type IS NOT NULL')->groupBy('id');

        $querySphinx = new Query;
        $ids = [];
        if ($this->searchText) {
            $rows = $querySphinx->from('sh_search')
                ->select('ids')
                ->where('user_id = ' . \Yii::$app->user->id)
                ->limit(99999)
                ->match(new Expression(':match', [':match' =>  $this->GetSphinxKeyword($this->searchText)]))
                ->all();
              
            if (count($rows) > 0) {
                foreach ($rows as $row) {
                    $ids[] = $row['ids'];
                }
            }else{
                $ids[] = 'nothing';
            }
        }


        $query->joinWith([
            'project' => function ($q) {
                if ($this->projectName != '') {
                    $q->where(['IN', 'projects.title', $this->projectName]);
                }
            }
        ]);

        $query->with([
            'keywords' => function ($q) {
                $q->where('extracted_keywords.text LIKE "%' . $this->keywordString . '%"');
            }
        ]);

        $query->with([
            'concepts' => function ($q) {
                $q->where('extracted_concepts.text LIKE "%' . $this->conceptString . '%"');
            }
        ]);

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




//        if (!$this->validate()) {
//
//            return $dataProvider;
//        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doc_id' => $this->doc_id,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'page_number' => $this->page_number,
            'line_number' => $this->line_number,
            'paragraph_number' => $this->paragraph_number,

        ]);

        if ($this->docName != '') {
            $query->andFilterWhere(['IN', 'documents.title', $this->docName]);
        }

        if ($this->searchText) {
            $query->andFilterWhere(['IN', 'sentences_plus_hl.id', $ids]);
        }

        if ($this->entity_type != '') {
            $query->andFilterWhere(['IN', 'entity_type', $this->entity_type]);
        }

        if ($this->entity != '') {
            $query->andFilterWhere(['IN', 'entity', $this->entity]);
        }

        if ($this->tag_type != '') {

            $query->andFilterWhere(['IN', 'tag_type', $this->tag_type]);
        }


        $query
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'manual_date', $this->manual_date])
            ->andFilterWhere(['like', 'positions', $this->positions])
            ->andFilterWhere(['like', 'sent_hl', $this->sent_hl])
            ->andFilterWhere(['like', 'meta_data', $this->meta_data])
            ->andFilterWhere(['like', 'page_number', $this->reference])
            ->andFilterWhere(['like', 'line_number', $this->reference])
            ->andFilterWhere(['like', 'paragraph_number', $this->reference]);

        return $dataProvider;
    }


    private  function GetSphinxKeyword($sQuery)
    {
        $aKeyword = '';
        $sQuery = str_replace('/', ' ', $sQuery);

        $aRequestString = preg_split('/[\s,-]+/', $sQuery, 5);

        if ($aRequestString) {
            foreach ($aRequestString as $sValue) {
                if (strlen($sValue) > 0) {
                    $aKeyword[] = "(" . $sValue . " | *" . $sValue . "*)";
                }
            }
            $sSphinxKeyword = implode(" | ", $aKeyword);
        }
        return $sSphinxKeyword;
    }
}
