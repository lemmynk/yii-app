<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sector */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sectors', 'url' => ['index']];
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
                            'file_name',
                            //'sector_type',
                            [
                                'label' => 'Sector Type',
                                'value' => function($model){
                                    return $model->getSectorTypeText();
                                }
                            ],
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
                    <?= Html::a('Add Content', ['add-content', 'id' => $model->id], ['id' => 'addC', 'class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php \yii\widgets\Pjax::begin(['id' => 'assign-content', 'clientOptions' => ['method' => 'POST']]) ?>
                    <?=   \yii\grid\GridView::widget([
                        'dataProvider' => $assigns,
                        'columns' => [
                            [
                                'label' => 'Content',
                                'value' => function($data){
                                    if ($data->content_type == 'C'){
                                        $ret = $data->content->name;
                                    }else{
                                        $ret = $data->widget->name;
                                    }
                                    return $ret;
                                }
                            ],
                            [
                                'label' => 'Content Type',
                                'value' => function($data){
                                    return $data->getContentTypeText();
                                }
                            ],
                            //[
                                //'label' => 'Page',
                                //'value' => function($data){
                                    //return $data->page->name;
                                //}
                            //],
                            [
                                'label' => 'Status',
                                'value' => function($data){
                                    return $data->getStatusText($data->status);
                                }
                            ],
                            'order_by',
                            [
                                'class' => 'hail812\adminlte3\yii\grid\ActionColumn',
                                //'header' => 'Actions',
                                'controller' => 'assign-content',
                                'template' => "{activate}&nbsp;&nbsp;{delete}",
                                'buttons' => [
                                    'activate' => function($url, $data){
                                        $options = [
                                            'title' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'aria-label' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'class' => 'change-assign',
                                            'change-url' => $url,
                                            'pjax-container' => 'assign-content',
                                            'data-pjax' => '0' ,
                                        ];
                                        return Html::a('<span class="fas fa-sync"></span>', $url, $options);
                                    }
                                ],
                                //'urlCreator' => function($action, $data, $key, $index){
                                    //return $url = \yii\helpers\Url::to(['assign-content/activate', 'id' => $data->id]);
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
                                var changeUrl = $(this).attr("change-url");
                                $.ajax({
                                        url: changeUrl,
                                        type: "post",
                                        error: function(xhr, status, error) {
                                            alert("There was an error with your request." + xhr.responseText);
                                        }
                                    }).done( function () {
                                        $.pjax.reload({container:"#assign-content"});  //Reload GridView
                                    });
                            });'
                    ); /**/ ?>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs(
'$("#addC").on("click", function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr("href"),
        type: "get",
    }).done( function (data) {
            $("#addContentTag").html(data);  //Reload GridView
            $("#addContent").modal("toggle");
            return false;
        });
    });'
); /**/
    \yii\bootstrap4\Modal::begin([
            'id' => 'addContent'
    ]); ?>
        <div id="addContentTag"></div>
<?php \yii\bootstrap4\Modal::end();


