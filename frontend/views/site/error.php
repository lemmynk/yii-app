<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

//$this->title = $exception->statusCode .' '. $exception->getName();
$this->title = $name;
?>
<div class="site-error" style="text-align: center">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger" style="margin-left: 25%; margin-right: 25%;">
        <?php // nl2br(Html::encode($exception->getMessage())) ?>
        <?php echo nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        <!--Please contact us if you think this is a server error. Thank you.-->
        <?= Html::a('Return to Home page', [\yii\helpers\Url::to('site/index')]) ?>
    </p>

</div>
