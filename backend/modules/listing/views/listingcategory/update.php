<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingCategory */

$this->title = 'Update Listing Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Listing Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'pages' => $pages,

                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>