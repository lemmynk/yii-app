<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 14/01/24
 * Time: 20:53
 */

use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
use common\helpers\Myfunctions;
?>
<!--<div class="col">
    <h2><?php // Html::encode($model->item_title) ?></h2>

    <p><?php // strip_tags(HTMLPurifier::process($model->html_list),'<img>') ?></p>
    <?php // Html::a('Procitaj sve' ,[$itemBaseUrl . $model->item_seo]) ?>
</div>-->


    <div class="card">
        <div class="card-img"><img src="<?= $model->getHtmlListImgSrc() ?> " style="width: 100%; height: auto"></div>
        <div class="card-body">
            <h5 class="card-title">
                <?= Html::a(Html::encode($model->item_title), [$itemBaseUrl . $model->item_seo]) ?>
            </h5>
            <p class="fst-italic text-center"><?= $model->formatDate($model->created_on )?></p>
            <p class="card-text"><?= $model->removeImgTags() ?></p>
        </div>
    </div>
<br>

