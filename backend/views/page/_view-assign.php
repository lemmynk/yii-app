<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 15/01/24
 * Time: 12:15
 */
use yii\helpers\Html;
?>
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
                    <?php \yii\widgets\Pjax::begin(['id' => 'template-sector']) ?>
                    <?php echo \yii\grid\GridView::widget([
                        'dataProvider' => $assigns,
                        'columns' => [
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
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => "{activate}&nbsp;&nbsp;{delete}",
                                'buttons' => [
                                    'activate' => function($url, $data){
                                        $options = [
                                            'title' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'aria-label' => $data->status === 0 ? 'Activate' : 'Deactivate',
                                            'class' => 'change-assign',
                                            'change-url' => $url,
                                            'pjax-container' => 'template-sector',
                                            'data-pjax' => '0' ,
                                        ];
                                        return Html::a('<span class="fas fa-sync"></span>', $url, $options);
                                    },
                                    'delete' => function($url, $data){
                                        $options = [
                                            'title' =>'Delete',
                                            'aria-label' => 'Delete',
                                            'class' => 'change-assign',
                                            'change-url' => $url,
                                            'pjax-container' => 'template-sector',
                                            'data-pjax' => '0' ,
                                        ];
                                        return Html::a('<span class="fas fa-trash"></span>', $url, $options);
                                    }
                                ],
                                'urlCreator' => function($action, $data, $key, $index){
                                    if ($action === 'activate'){
                                        return $url = \yii\helpers\Url::to(['assign-content/activate', 'id' => $data->id]);
                                    }
                                    if ($action === 'delete'){
                                        return $url = \yii\helpers\Url::to(['assign-content/delete', 'id' => $data->id]);
                                    }
                                }
                            ]
                        ],
                        'summaryOptions' => ['class' => 'summary mb-2'],
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                        ]
                    ]) /**/ ?>
                    <?php \yii\widgets\Pjax::end() ?>

                    <?php $this->registerJs(
                        '$(".change-assign").on("click", function(e) {
                                e.preventDefault();
                                var changeUrl = $(this).attr("href");
                                $.ajax({
                                        url: changeUrl,
                                        type: "get",
                                        error: function(xhr, status, error) {
                                            alert("There was an error with your request." + xhr.responseText);
                                        }
                                    }).done( function (data) {
                                        $.pjax.reload({container:"#template-sector"});  //Reload GridView
                                    });
                            });'
                    ); /**/ ?>
                </div>
            </div>
        </div>
    </div>
</div>
