<?php

use yii\helpers\Html;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>



                    <?= DataTables::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            //'role',
                            [
                                'label' => 'Name',
                                'value' => function($data){
                                    return $data->getUserFullName();
                                }
                            ],
                            [
                                'label' => 'Role',
                                'value' => function($data){
                                    return $data->getRoleText();
                                }
                            ],
                            'username',
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            //'password',
                            //'auth_key',
                            //'first_name',
                            //'last_name',
                            //'email:email',
                            //'note:ntext',
                            //'login_counter',
                            //'last_login_on',
                            //'status',
                            //'created_by',
                            //'created_on',
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
