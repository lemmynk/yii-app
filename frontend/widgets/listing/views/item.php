<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 15/01/24
 * Time: 15:49
 */

use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
use common\helpers\Myfunctions;
?>
<div class="col">
    <h2><?= Html::encode($item->item_title) ?></h2>

    <p><?php echo $item->removeImgTagsFromContent() ?></p>


    <section id="gallery" class="gallery section">
        <div class="container-fluid aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-center">

                <?php
                foreach (Myfunctions::extractImgSrc($item->html_content, true) as $imgSrc){ ?>

                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-item w-100">
                            <img src="<?= $imgSrc ?>" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="<?= $imgSrc ?>"  class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>

                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </section>
</div>
