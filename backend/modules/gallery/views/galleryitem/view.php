<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\gallery\models\Galleryitem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Galleryitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

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
                            [
                                'attribute'=>'name',
                                'value'=>$model->name,
                                'format' => ['image',['width'=>'200','height'=>'200']],

                            ],
                            [
                                'label' => 'Status',
                                'value' => function($model){
                                    return $model->getStatusText($model->status);
                                }
                            ],
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