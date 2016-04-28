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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'doc_id',
            'tag_id',
            'user_id',
            'project_id',
            // 'entity_id',
            // 'date_id',
            // 'note:ntext',
            // 'manual_date',
            // 'page_number',
            // 'line_number',
            // 'paragraph_number',
            // 'positions',
             'sent_hl:ntext',
            // 'meta_data',


        ],
    ]); ?>
</div>
