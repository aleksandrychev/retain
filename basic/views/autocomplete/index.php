<?php
use \yii\widgets\ActiveForm;

$this->title = 'Project Report';
/* @var $this yii\web\View */
?>
<h1>Project's report</h1>
<div class="row">
    <div class="col-md-6">

        <?= \yii\bootstrap\Html::activeDropDownList($model, 'project_id',
            \yii\helpers\ArrayHelper::map($projects, 'id', 'title'), ['prompt' => 'Select Project']); ?>

        <br/> <br/>
        <?php if (\Yii::$app->request->get('project_id')) { ?>


        <?php $form = ActiveForm::begin(['id' => 'textform']); ?>
        <?= $form->field($model, 'text')->textarea(['rows' => '15'])->label(false); ?>

        <?= \yii\helpers\Html::submitButton('Save Report', ['class' => 'btn btn-success savedoc']) ?>

        <?= \yii\helpers\Html::button('Download .docx', ['class' => 'btn btn-info htmtodocx']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-lg-6">
        <?= $this->render('tabs', ['selectedProject' => $selectedProject, 'importModel' => $importModel]) ?>
    </div>


</div>
    <button style="display: none;" class="btn ite btn-warning">insert to editor</button>
<?php

$this->registerJs("
entitiesArr = " . $selectedProject->getEntityForAutocomplete() . ";
projectId = " . $model->project_id . ";
");

$this->registerJsFile('/js/jquery.textcomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/notify/bootstrap-notify.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/vendor/bower/tinymce-mention/mention/plugin.js
', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/js/vendor/bower/tinymce-mention/css/autocomplete.css');
$this->registerJsFile('/js/vendor/bower/tinymce-dist/tinymce.js');
$this->registerJsFile("/js/autocomplete.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php } ?>
<?php $this->registerJs("$('#autocompleteform-project_id').change(function(){
window.location = '/autocomplete?project_id=' + $(this).val();
});") ?>

<style>
    .container {width: 98% !important;}
</style>