<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 14/01/24
 * Time: 23:16
 */
use yii\widgets\ListView;



echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_items',
    'pager'=> [
        'class' => 'yii\bootstrap4\LinkPager',
        'maxButtonCount' =>5,
        ],
    'summary' => false,
    'viewParams' => [
        'itemBaseUrl' => $itemBaseUrl
    ],
]);