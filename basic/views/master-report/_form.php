<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ar\SentencesPlusHl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentences-plus-hl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doc_id')->textInput() ?>

    <?= $form->field($model, 'tag_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'entity_id')->textInput() ?>

    <?= $form->field($model, 'date_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manual_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_number')->textInput() ?>

    <?= $form->field($model, 'line_number')->textInput() ?>

    <?= $form->field($model, 'paragraph_number')->textInput() ?>

    <?= $form->field($model, 'positions')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sent_hl')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_data')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
