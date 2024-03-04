<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingCategory */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="listing-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'modify_by')->textInput() ?>

    <?= $form->field($model, 'modify_on')->textInput() ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
