<?php
	session_start();
?>
<!DOCETYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Shopping</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <?php
			require("navbar.php");
		?>
        <div data-content-type="block" data-appearance="default" data-element="main" data-pb-style="JDEOHKS">
            <div class="widget block block-static-block">
                <style>
                </style>
                <div data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0"
                    data-parallax-speed="0.5" data-background-images="{}" data-background-type="image"
                    data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true"
                    data-video-fallback-src="" data-element="main" data-pb-style="KPP8PNN">
                    <div data-content-type="html" data-appearance="default" data-element="main" data-pb-style="GGMOCHH"
                        data-decoded="true">
                        <div class="chpair">
                            <picture style="width:100%;">
                                <source media="(max-width:640px)" srcset="img/champion_min3.png">
                                <img alt="" src="img/champion2.png" style="width:100%;">
                            </picture>
                            <div class="overlay">
                                <h2>
                                    <span>Stay in style with us</span>
                                </h2>
                                <p>
                                    Cooler days call for dialed up styles that give new season energy
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="img/features/f1.png" alt="">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f2.png" alt="">
                <h6>Online Order</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f3.png" alt="">
                <h6>Promotions</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f4.png" alt="">
                <h6>24/7 Support</h6>
            </div>
        </section>

        <section id="banner" class="section-m1">
            <h4>Repair Services</h4>
            <h2><span>Free</span> Shipping</h2>
            <button class="normal"><a href="shop.php">Explore More</a></button>


        </section>


		<?php
			include("newsletter.php");
			include("footer.php");
		?>
        <script src="main.js"></script>
    </body>



    </html>