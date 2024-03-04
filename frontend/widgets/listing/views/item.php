<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 15/01/24
 * Time: 15:49
 */

use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
?>
<div class="col">
    <h2><?= Html::encode($item->item_title) ?></h2>

    <p><?= strip_tags(HTMLPurifier::process($item->html_content), '<img>') ?></p>
</div>
