<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\search\SentencesPlusHlSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentences-plus-hl-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'doc_id') ?>

    <?= $form->field($model, 'tag_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'entity_id') ?>

    <?php // echo $form->field($model, 'date_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'manual_date') ?>

    <?php // echo $form->field($model, 'page_number') ?>

    <?php // echo $form->field($model, 'line_number') ?>

    <?php // echo $form->field($model, 'paragraph_number') ?>

    <?php // echo $form->field($model, 'positions') ?>

    <?php // echo $form->field($model, 'sent_hl') ?>

    <?php // echo $form->field($model, 'meta_data') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
