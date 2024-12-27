<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Galleryitem */

$this->title = 'Create Galleryitem';
$this->params['breadcrumbs'][] = ['label' => 'Galleryitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>