<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\listing\models\ListingItem */

$this->title = $model->item_title;
$this->params['breadcrumbs'][] = ['label' => $model->category->cat_title, 'url' => ['index', 'id' => $model->category->cat_seo]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= hail812\adminlte\widgets\Alert::widget([]); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'id',
                            //'category_id',
                            //'category_name',
                            'item_title',
                            'item_seo',
                            'item_author',
                            'item_date:datetime',
                            [
                                'label' => 'Status',
                                'value' => function($model){
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            'html_list:html',

                            'html_content:html',

                            //'html_widget:ntext',
                            //'item_order',
                            //'widget',
                            //'widget_order',
                            //'archive',
                            [
                                'label' => 'Created by',
                                'value' => function($model){
                                    return $model->creator->getUserFullName();
                                }
                            ],
                            'created_on:datetime',
                            [
                                'label' => 'Modify by',
                                'value' => function($model){
                                    return $model->editor->getUserFullName();
                                }
                            ],
                            'modify_on:datetime',
                            [
                                'label' => 'Deleted',
                                'value' => function($model){
                                    return $model->getDeletedText($model->deleted);
                                }
                            ],
                        ],
                    ]) ?>
                </div>
                <!--.col-md-12-->
            </div>
            <!--.row-->
        </div>
        <!--.card-body-->
    </div>
    <!--.card-->
</div>