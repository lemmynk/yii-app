<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
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
                            'name',
                            [
                                'label' => 'Status',
                                'value' => function($model){
                                    return $model->getStatusText($model->status);
                                }
                            ],
                            //'deleted',
                            [
                                'label' => 'Created by',
                                'value' => function($model){
                                    return $model->creator->getUserFullName();
                                }
                            ],
                            'created_on:datetime',
                            //'created_by',
                            [
                                'label' => 'Modify by',
                                'value' => function($model){
                                    return $model->editor->getUserFullName();
                                }
                            ],
                            'modify_on:datetime',
                            //'modify_by',
                            [
                                'label' => 'Deleted',
                                'value' => function($data){
                                    return $data->getDeletedText($data->deleted);
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
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Assigned Sectors</h2>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-12">
                    <?= Html::a('Add Sector', ['addsector', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php \yii\widgets\Pjax::begin(['id' => 'template-sector', 'clientOptions' => ['method' => 'POST']]) ?>
                    <?php   echo \yii\grid\GridView::widget([
                        'dataProvider' => $sectors,
                        'columns' => [
                            [
                                    'label' => 'Sector',
                                    'value' => function($data){
                                        return $data->sctr->name;
                                    }
                            ],
                            [
                                'label' => 'Sector Type',
                                'value' => function($data){
                                    return $data->sctr->getSectorTypeText();
                                }
                            ],
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->sctr->getStatusText($data->status);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => "{activate}",
                                'buttons' => [
                                    'activate' => function($url, $data){
                                        $options = [
                                            'title' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'aria-label' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'class' => 'change-sector',
                                            'change-url' => $url,
                                            'pjax-container' => 'template-sector',
                                            'data-pjax' => '0' ,
                                        ];
                                        return Html::a('<span class="fas fa-sync"></span>', $url, $options);
                                    }
                                ],
                                'urlCreator' => function($action, $data, $key, $index){
                                        return $url = \yii\helpers\Url::to(['sector/activate', 'id' => $data->id]);
                                }
                            ],
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]) /**/ ?>
                    <?php $this->registerJs(
                        '$(".change-sector").on("click", function(e) {
                                e.preventDefault();
                                var changeUrl = $(this).attr("change-url");
                                $.ajax({
                                        url: changeUrl,
                                        type: "post",
                                        error: function(xhr, status, error) {
                                            alert("There was an error with your request." + xhr.responseText);
                                        }
                                    }).done( function () {
                                        $.pjax.reload({container:"#template-sector"});  //Reload GridView
                                    });
                            });'
                    ); /**/ ?>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
