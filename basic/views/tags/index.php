<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


<?php
//For subtag improvement
/*

    <div class="easy-tree">
        <ul>
            <?php
            foreach($model as $data){

                echo '<li data-id="'. $data->id .'">'. $data->title .'</li>';

            }
            ?>
        </ul>
    </div>

<?php
$js ="(function ($) {
            function init() {
                $('.easy-tree').EasyTree({
                    addable: true,
                    editable: true,
                    deletable: true
                });
            }

            window.onload = init();
        })(jQuery)";
$this->registerJsFile('/js/tree/src/easyTree.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs($js);
$this->registerCssFile('/js/tree/css/easyTree.css');
?>

*/ ?>