<section id="gallery" class="gallery section">
    <div class="container-fluid aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">

    <?php
foreach ($items as $item){ ?>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="gallery-item h-100">
                      <img src="<?= $item->name ?>" class="img-fluid" alt="">
                  <div class="gallery-links d-flex align-items-center justify-content-center">
                        <a href="<?= $item->name ?>" title="Gallery 1" class="glightbox preview-link"><i class="bi bi-arrows-angle-expand"></i></a>

                  </div>
                </div>
              </div>

<?php } ?>
        </div>
    </div>
</section>
