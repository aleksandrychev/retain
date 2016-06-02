<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\Projects */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h2><?= $model->title ?></h2>

    <div>
        <label for="autocomplite">Autocomplited text:</label>
        <textarea class="form-control" rows="5" id="autocomplite"><?= $model->text ?>
        </textarea>

       <?= Html::button('save',['class'=>'btn saveText btn-defalut pull-right']) ?>
    </div>

    <div class="row" style="margin-top: 30px;">
        <?php
        $form = ActiveForm::begin([
            'id' => "file",
            'class' => 'file-form',
            'options' => ['class' => 'form-horizontal', 'target' => "_blank", 'enctype' => 'multipart/form-data'],
            'action' => '/upload/load'
        ]) ?>
        <div class="col-md-5">
            <?= Html::label("Choose document to upload: ", 'uploadsmodel-file') ?>
            <?= $form->field(new app\models\logic\UploadsModel(),
                'file')->fileInput(['class' => 'fileinput'])->label(false) ?>
            <?= $form->field(new app\models\logic\UploadsModel(),
                'projectId')->hiddenInput(['value' => $model->id])->label(false) ?>
        </div>
        <div class="col-md-1">
            <?= Html::submitButton('<span class="glyphicon glyphicon-cog"></span> &nbsp;Process',
                ['class' => 'btn btn-success btn-xs', 'style' => 'display: none;']) ?>
            <?= Html::hiddenInput('_csrf', Yii::$app->request->getCsrfToken()) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>

    <h3>Uploaded documents</h3>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id' => [
                'header' => 'Document ID',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->id;
                },
            ],
            'title' => [
                'header' => 'Document',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<a target="_blank" href="' . \yii\helpers\Url::toRoute('documents/view/' . $model->id) . '">' . $model->title . '</a>';
                },
            ],
            'entitiesCount',
            'datesCount',
        ],
    ]); ?>


</div>
<?php
$script = <<<JS
$('.form-horizontal').unbind('submit');
$('.form-horizontal').submit(function(){
var ext = $(this).find('.fileinput').val().split('.').pop().toLowerCase();

if($.inArray(ext, ['pdf','doc','docx']) == -1) {
    alert('invalid extension!');
    return false;
}
});
$('.fileinput').change(function(){
var ext = $(this).val().split('.').pop().toLowerCase();
if($.inArray(ext, ['pdf','doc','docx']) == -1) {
$(this).closest('form').find('.btn').hide();

} else{
$(this).closest('form').find('.btn').show();
}
});
JS;
$this->registerJs($script);


$this->registerJsFile('/js/jquery.textcomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJs("

$('textarea').textcomplete([{
    match: /(^|\b)(\w{2,})$/,
    search: function (term, callback) {
        var words = " . $model->getEntityForAutocomplete() . ";
        callback($.map(words, function (word) {
             return word.toLowerCase().indexOf(term.toLowerCase()) === 0 ? word : null;
        }));
    },
    replace: function (word) {
        return word + ' ';
    }
  }]);

  $(document).ready(function(){

  $('.saveText').click(function(){

  $.ajax({
  type: \"POST\",
  url: \"/projects/set-text\",
  data: {id: \"". $model->id ."\", text:  $('#autocomplite').val() },
  success: function(){
   $.notify({
                message: 'Text was successful saved',
            }, {

                type: 'success'
            });

  },

});

  });

  });

");
$this->registerJsFile('/js/notify/bootstrap-notify.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<style>
    .form-group {
        display: inline-block;
        vertical-align: top;
    }

    label {
        display: inline-block;
        margin-right: 20px !important;
    }
</style>