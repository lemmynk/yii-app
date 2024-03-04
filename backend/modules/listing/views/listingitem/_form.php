<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingItem */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="listing-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'item_author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_date')->widget(yii\jui\DatePicker::className(), [
            'options' => [
                    'class' => 'form-control'
            ],
            'dateFormat'=>'php:d-m-Y'
    ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'html_list')->widget(alexantr\tinymce\TinyMCE::className(), [
        'presetPath' => '@backend/config/tinymce.php'
    ]) ?>

    <?= $form->field($model, 'html_content')->widget(alexantr\tinymce\TinyMCE::className(), [
        'presetPath' => '@backend/config/tinymce.php'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel' , \yii\helpers\Url::to(['index', 'id' => $category->cat_seo]), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
