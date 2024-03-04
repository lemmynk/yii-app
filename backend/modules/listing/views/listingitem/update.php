<?php

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingItem */

$this->title = 'Update: ' . $model->item_title;
$this->params['breadcrumbs'][] = ['label' => $category->cat_title, 'url' => ['index', 'id' => $category->cat_seo]];
$this->params['breadcrumbs'][] = ['label' => $model->item_title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?=$this->render('_form', [
                        'model' => $model,
                        'category' => $category
                    ]) ?>
                </div>
            </div>
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>