<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sector */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="sector-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sector_type')->dropDownList([ 'T' => 'Template', 'P' => 'Page', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tpl_id')->dropDownList($templates, ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
