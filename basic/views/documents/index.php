<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Results Archive';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [


            'id',
            'title' => [
                'header' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a target="_blank" href="'. \yii\helpers\Url::toRoute('documents/view/' . $model->id) .'">'. $model->title . '</a>';
                },
            ],
            'entitiesCount',
            'datesCount',
//            Dates extracted by alchemy
//            Entities Extracted by Alchemy
        ],
    ]); ?>

</div>
