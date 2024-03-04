<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingItem */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => $category->cat_title, 'url' => ['index', 'id' => $category->cat_seo]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'category' => $category,
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>