<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sectors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create Sector', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'name',
                            'file_name',
                            [
                                'label' => 'Sector Type',
                                'value' => function($data){
                                    return $data->getSectorTypeText();
                                }
                            ],
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            //'status',
                            //'deleted',
                            //'created_on',
                            //'created_by',
                            //'modify_on',
                            //'modify_by',

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
