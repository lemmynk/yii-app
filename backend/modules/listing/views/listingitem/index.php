<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $category->cat_title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('<span class="fas fa-plus"></span> &nbsp; Create', ['create', 'id' => $category->cat_seo], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= \fedemotta\datatables\DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'rowOptions' => function($model){
                            if ($model->deleted == 1){
                                return ['class' => 'btn-danger'];
                            }
                            if ($model->status == 0){
                                return ['class' => 'btn-warning'];
                            }
                        },
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            //'category_id',
                            //'category_name',
                            //'created_on:datetime',
                            'item_title',
                            //'item_seo',
                            //'item_author',
                            //'item_date',
                            //'html_content:ntext',
                            //'html_list:ntext',
                            //'html_widget:ntext',
                            //'item_order',
                            //'widget',
                            //'widget_order',
                            //'status',
                            //'archive',
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            [
                                'label' => 'Created by',
                                'value' => function($data){
                                    return $data->creator->getUserFullName();
                                }
                            ],
                            [
                                'attribute' => 'created_on',
                                'format' => ['date', 'php:d-m-Y']
                            ],
                            //'created_on:datetime',
                            //'modify_by',
                            //'modify_on',
                            //'deleted',
                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],
                        //'summaryOptions' => ['class' => 'summary mb-2'],
                        //'pager' => [
                            //'class' => 'yii\bootstrap4\LinkPager',
                        //]
                    ]); ?>


                </div>
                <!--.card-body-->
            </div>
            <!--.card-->
        </div>
        <!--.col-md-12-->
    </div>
    <!--.row-->
</div>
