<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Retain';
?>
<div class="site-index">
    <h2>Upload Document/s</h2>
    <?php for ($i = 1; $i < 4; $i++) { ?>
        <div class="row" style="margin-top: 30px;">
            <?php
            $form = ActiveForm::begin([
                'id' => "file-$i",
                'class' => 'file-form',
                'options' => ['class' => 'form-horizontal', 'target' => "_blank", 'enctype' => 'multipart/form-data'],
                'action' => '/upload/load'
            ]) ?>
            <div class="col-md-5">
                <?= Html::label("Choose $i file: ", 'uploadsmodel-file') ?>
                <?= $form->field($modelUpload, 'file')->fileInput(['class'=>'fileinput'])->label(false) ?>
            </div>
            <div class="col-md-1" >
                <?= Html::submitButton('<span class="glyphicon glyphicon-cog"></span> &nbsp;Process', ['class' => 'btn btn-success btn-xs', 'style' => 'display: none;']) ?>
                <?= Html::hiddenInput('_csrf', Yii::$app->request->getCsrfToken()) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    <?php } ?>
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
?>
<style>
    .form-group  {display: inline-block;vertical-align: top;}
    label {display:inline-block;margin-right: 20px !important;}
</style>