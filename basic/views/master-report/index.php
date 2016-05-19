<?php


/* @var $this yii\web\View */
/* @var $searchModel app\models\ar\search\SentencesPlusHlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Report';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="sentences-plus-hl-index">

        <h1>Master Report <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseOptions"
                             aria-expanded="false" aria-controls="collapseOptions">
                select columns to view
            </a></h1>

        <?= $this->render('settings', ['model' => $model, 'settings' => $settings]) ?>
        <?= $this->render('_search', ['model' => $searchModel]); ?>

        <?php \yii\widgets\Pjax::begin(); ?>
        <?= $this->render('table',
            ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'settings' => $settings]) ?>

    </div>

<?php

$js = '

 var gridview_id = ""; // specific gridview
 var columns = [5]; // index column that will grouping, start 1


var column_data = [];
column_start = [];
rowspan = [];

for (var i = 0; i < columns.length; i++) {
    column = columns[i];
    column_data[column] = "";
    column_start[column] = null;
    rowspan[column] = 1;
}

var row = 1;
$(gridview_id+" table > tbody  > tr").each(function() {
    var col = 1;
    $(this).find("td").each(function(){
        for (var i = 0; i < columns.length; i++) {
            if(col==columns[i]){
                if(column_data[columns[i]] == $(this).html()){
                    $(this).remove();
                    rowspan[columns[i]]++;
                    $(column_start[columns[i]]).attr("rowspan",rowspan[columns[i]]);
                }
                else{
                    column_data[columns[i]] = $(this).html();
                    rowspan[columns[i]] = 1;
                    column_start[columns[i]] = $(this);
                }
            }
        }
        col++;
    })
    row++;
});';

$this->registerJs($js);

$this->registerJsFile('/js/bootstrap-switch.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/bootstrap-switch.css');
$this->registerJs('$(".send_to_final_report").bootstrapSwitch();');

$this->registerJsFile('/js/bootstrap-multiselect.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/bootstrap-multiselect.css');
$this->registerJs('$(".multiselect").multiselect({
            numberDisplayed: 1,
            enableFiltering: true,
            filterBehavior: "value",
        });');
?>
<?php \yii\widgets\Pjax::end(); ?>

<?php $this->registerJsFile('/js/app.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>