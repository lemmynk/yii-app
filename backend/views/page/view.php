<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
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
                            'url:url',
                            [
                                'label' => 'Template',
                                'value' => function($model){
                                    return $model->template->name;
                                }
                            ],
                            'title',
                            'keywords',
                            'description',
                            //'lang_id',
                            //'status',
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
                <h2>Assigned Content</h2>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-12">
                    <?= Html::a('Add Content', ['add-content', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php \yii\widgets\Pjax::begin(['id' => 'template-sector', 'clientOptions' => ['method' => 'POST']]) ?>
                    <?php echo \yii\grid\GridView::widget([
                        'dataProvider' => $assigns,
                        'columns' => [
                                'id',
                            [
                                'label' => 'Sector',
                                'value' => function($data){
                                    return $data->sector->name;
                                }
                            ],
                            [
                                'label' => 'Content',
                                'value' => function($data){
                                    if ($data->content_type == 'C'){
                                        return $data->content->name;
                                    }else{
                                        return $data->widget->name;
                                    }

                                }
                            ],
                            [
                                'label' => 'Content Type',
                                'value' => function($data){
                                    return $data->getContentTypeText();
                                }
                            ],
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            'order_by',
                            [
                                'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'controller' => 'assign-content',
                                'template' => "{activate}&nbsp;&nbsp;{delete}",
                                //'buttons' => [
                                    //'activate' => function($url, $data){
                                        //$options = [
                                            //'title' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            //'aria-label' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            //'class' => 'change-assign',
                                            //'change-url' => $url,
                                            //'pjax-container' => 'template-sector',
                                            //'data-pjax' => true ,
                                        //];
                                        //return Html::a('<span class="fas fa-sync"></span>', $url, $options);
                                    //},
                                    //'delete' => function($url, $data){
                                        //$options = [
                                            //'title' =>'Delete',
                                            //'aria-label' => 'Delete',
                                            //'class' => 'change-assign',
                                            //'change-url' => $url,
                                            //'pjax-container' => 'template-sector',
                                            //'data-pjax' => true ,
                                        //];
                                        //return Html::a('<span class="fas fa-trash"></span>', $url, $options);
                                    //}
                                //],
                                //'urlCreator' => function($action, $data, $key, $index){
                                    //if ($action === 'activate'){
                                        //return $url = \yii\helpers\Url::to(['assign-content/activate', 'id' => $data->id]);
                                    //}
                                    //if ($action === 'delete'){
                                        //return $url = \yii\helpers\Url::to(['assign-content/delete', 'id' => $data->id]);
                                    //}
                                //}
                            ]
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]) /**/ ?>

                    <?php $this->registerJs(
                        '$(".change-assign").on("click", function(e) {
                                e.preventDefault();
                                var changeUrl = $(this).attr("href");
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