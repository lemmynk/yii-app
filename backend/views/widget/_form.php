<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Widget */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="widget-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropdownList($model->getWidgetTypeOptions(), [
        'prompt' => 'Select type',
        'onchange' =>

                '$.get("module-categories?id="+$(this).val(), function(data) {
                    $("#mod-cat").html(data);                  
                })'

    ]) ?>

    <?= $form->field($model, 'module_category_id')->dropdownList([], ['id' => 'mod-cat']) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
