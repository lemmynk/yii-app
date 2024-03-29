<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 16/01/24
 * Time: 22:10
 */
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Nav;
?>

<!-- ======= Header ======= -->


<h1 class="logo me-auto"><a href="index.html">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

<nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
        <li><a href="index.html">Pocetna</a></li>
        <li><a href="about.html">Obavestenja</a></li>
        <li><a href="courses.html">Informacije</a></li>
        <li><a href="trainers.html">Zaposleni</a></li>
        <li><a href="events.html">Ucenici</a></li>
        <li><a href="pricing.html">Roditelji</a></li>
        <li><a href="pricing.html">Timovi</a></li>
        <li><a href="pricing.html">Dokumenta</a></li>
        <li><a href="pricing.html">Javne nabavke</a></li>
        <li><a href="pricing.html">Letopis</a></li>
        <li><a href="pricing.html">Kontakt</a></li>

        <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                    <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                        <li><a href="#">Deep Drop Down 3</a></li>
                        <li><a href="#">Deep Drop Down 4</a></li>
                        <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                </li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
            </ul>
        </li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
</nav><!-- .navbar -->
<!-- End Header -->
