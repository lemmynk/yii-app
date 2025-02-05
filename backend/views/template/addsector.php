<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 30/12/23
 * Time: 16:49
 */
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = 'Add sector to Template';
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="template-form">

                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'sector_id')->dropdownList($sectors, ['prompt' => '']) ?>

                        <?= $form->field($model, 'order_by')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'status')->checkbox() ?>





                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                            <?= Html::a('Cancel', ['template/view', 'id' => $tplId], ['class' => 'btn btn-danger']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>