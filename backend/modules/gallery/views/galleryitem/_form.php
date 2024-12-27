<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Galleryitem */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="galleryitem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')
        ->widget(alexantr\elfinder\InputFile::className(), [
            'clientRoute' => 'elfinder/input',
            'filter' => ['image'],
            //'textarea' => true,
            'multiple' => true,
            'preview' => function ($value) {
                return yii\helpers\Html::img($value, ['width' => 200]);
            },
        ]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <div id="preview-img"></div>

</div>

<?php
$this->registerJs(<<<JS
        $("#galleryitem-name").change(function(){
            var arr = $(this).val().split(",");

            $.each(arr, function (key, value) {
                var img = $('<img style="border-radius: 5px; margin: 5px;">');
                img.attr('src', value);
                img.attr('width', 200);
                img.attr('height', 200);
                img.appendTo('#preview-img');
            })
            
});
JS
); ?>
