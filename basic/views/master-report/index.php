<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ar\search\SentencesPlusHlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentences-plus-hl-index">

    <h1>Master Report</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_id',
            'projectName',
            'docName',
            'note:ntext',
            'sent_hl:ntext',
            'meta_data',
            'reference',
            'tag_type',
            'entity_type',
            'entity',
            'keywordString',
            'conceptString'

            // 'entity_id',
            // 'date_id',

            // 'manual_date',
            // 'page_number',
            // 'line_number',
            // 'paragraph_number',
            // 'positions',

            // 'meta_data',


        ],
    ]); ?>
</div>
