<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingCategory */

$this->title = 'Create Listing Category';
$this->params['breadcrumbs'][] = ['label' => 'Listing Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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