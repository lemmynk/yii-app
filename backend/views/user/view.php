<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->getUserFullName();
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
                            'id',
                            [
                                    'label' => 'Name',
                                    'value' => function($model){
                                        return $model->getUserFullName();
                                    }
                            ],
                            //'role',
                            [
                                'label' => 'Role',
                                'value' => function($model){
                                    return $model->getRoleName($model->role);
                                }
                            ],
                            'username',
                            'password_hash',
                            //'auth_key',
                            //'first_name',
                            //'last_name',
                            'email:email',
                            'note:ntext',
                            'login_counter',
                            'last_login_on:datetime',
                            //'status',
                            [
                                'label' => 'Status',
                                'value' => function($model){
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            //'created_by',
                            [
                                'label' => 'Created by',
                                'value' => function($model){
                                    return $model->creator->getUserFullName();
                                }
                            ],
                            'created_on:datetime',
                            //'modify_by',
                            [
                                'label' => 'Modify by',
                                'value' => function($model){
                                    return $model->editor->getUserFullName();
                                }
                            ],
                            'modify_on:datetime',
                            //'deleted',
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