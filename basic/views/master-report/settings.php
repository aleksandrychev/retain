<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 18.05.16
 * Time: 15:59
 */
use \yii\widgets\ActiveForm;

?>

<div class="collapse" id="collapseOptions">
    <div class="well">
        <?php $form = ActiveForm::begin(); ?>
        <h4>Columns to view</h4>
        <?php foreach (\app\models\ar\MasterReportSettings::getLabels() as $key => $val) { ?>
            <label style="display: block">
                <?php
                $active = false;
                if ($settings == false) {
                    $active = true;
                } else {
                    if (isset($settings[$key])) {
                        $active = true;
                    }
                }
                ?>
                <?= \yii\helpers\Html::checkbox('columns[]', $active, ['value' => $key]) ?>
                <?= $val ?>
            </label>
        <?php } ?>

        <?= \yii\bootstrap\Html::submitButton('save', ['class' => 'btn btn-success']) ?>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>
