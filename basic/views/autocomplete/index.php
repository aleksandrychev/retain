<?php
use \yii\widgets\ActiveForm;

$this->title = 'Project Report';
/* @var $this yii\web\View */
?>
<h1>Project's report</h1>
<div class="row">
    <div class="col-md-8">

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
    <div class="col-lg-4">
        <?= $this->render('tabs') ?>
    </div>


</div>

<?php

$this->registerJs("

entitiesArr = " . $selectedProject->getEntityForAutocomplete() . ";
");

$this->registerJsFile('/js/jquery.textcomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/js/notify/bootstrap-notify.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/vendor/bower/tinymce-mention/mention/plugin.js
', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/js/vendor/bower/tinymce-mention/css/autocomplete.css');
//$this->registerJsFile('//cdn.tinymce.com/4/tinymce.min.js');
$this->registerJsFile('/js/vendor/bower/tinymce-dist/tinymce.js');

?>



<?php
$this->registerJs("

 function findKeysByPartValue( a, s )
                {
                var toReturn = []
                    for( var i = 0; i < a.length; ++i ) {

                        if (a[i].toLowerCase().indexOf(s.toLowerCase()) == 0) {
                            toReturn.push({\"name\": a[i]});
                        }
                    }
                    return toReturn;
                }






tinymce.init({
        selector: 'textarea',
        theme : 'modern',
        setup : function(ed) {

       ed.on('keydown', function( e ) {

          if(e.which == 8) {
          string = string.slice(0, -1);
          }

        }),
          ed.on('change', function () {
            ed.save();
        });
    },
        plugins :  'mention,fullscreen',
         toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen',
        mentions:{
        delimiter:  ['>parties','>company','>person','>date','>£','>$','>%','>location','>quantity'],
        source: function (query, process, delimiter) {

        var sourceArr = findKeysByPartValue(entitiesArr, delimiter );

if(sourceArr.length){
  process(sourceArr);
}else{
$.post({
  dataType: 'json',
  method: 'POST',
  url: '/autocomplete/mentions',
  data: {text: delimiter, project_id:" . $model->project_id . "},
  success:  function (data) {

          process(data)
       }
});
}





}

        }
});


$('.savedoc').on('click', function(e){
   e.preventDefault();

    $('#textform').attr('action', '').submit();
});

$('.htmtodocx').click(function(){

$('#textform').attr('action', '/autocomplete/get-doc').submit();

});

");


?>
<?php } ?>
<?php $this->registerJs("$('#autocompleteform-project_id').change(function(){
window.location = '/autocomplete?project_id=' + $(this).val();
});") ?>
