<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use nullref\datatable\DataTable;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Content', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'name',
                            //'lang_id',
                            //'content:ntext',
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            //'deleted',
                            //'created_on',
                            //'created_by',
                            //'modify_on',
                            //'modify_by',

                            ['class' => 'hail812\adminlte3\yii\grid\ActionColumn'],
                        ],

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
