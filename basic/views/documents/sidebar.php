<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 14.04.16
 * Time: 12:22
 */
?>

<h3>Highlighting</h3>
<div>
    <span class="ent-tag side-tag"><?= strip_tags($hlres->tag->title) ?> </span>


</div>




            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input data-id="<?=  $hlres->id ?>" data-value=""  data-field="date" value="<?=  $hlres->date ?>" type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>


<div>
    <pre><?= strip_tags($hlres->text) ?></pre>
</div>


<button class="glyphicon glyphicon-<?=  $hlres->note == '' ? 'plus' : 'edit'  ?> add-note btn btn-default" data-toggle="collapse" data-target=".note-area"><?=  $hlres->note == '' ? 'Add note' : 'Edit note'  ?></button>
    <div  class="collapse db-note note-area in">
        <code><?=  $hlres->note ?></code>
    </div>
<div  class="collapse note-area ">
    <div class="form-group">
        <label for="comment">Note:</label>
        <textarea class="form-control" rows="5" onkeyup="$('.save-note').attr('data-value', $(this).val())" id="note"><?= strip_tags($hlres->note) ?></textarea>

    </div>
    <button data-id="<?=  $hlres->id ?>" data-value="" data-field="note" class="save-note btn btn-success pull-right" onclick="saveAdditionalData(this, 'afterNoteSave(\''+ $(this).attr('data-value') +'\')');">save</button>
</div>
<?php
$script = "initDateP()";
$this->registerJs($script);

?>