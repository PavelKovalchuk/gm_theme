<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package StrapPress
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container footer-container">

            <div class="row footer-row-first">

                <div class="col-lg-1 footer-block footer-social-block ">

                    <div class="row flex-lg-column align-items-center justify-content-center footer-social-block-outer ">

                            <a class="d-flex justify-content-center footer-social-link" href="//www.facebook.com/GreenMarket.ua" >
                                <span class="social-links-img social-fb"></span>
                            </a>


                            <a class="d-flex justify-content-center footer-social-link" href="//twitter.com/greenmarket_ua" >
                                <span class="social-links-img social-twitter"></span>
                            </a>


                            <a class="d-flex justify-content-center footer-social-link" href="//plus.google.com/b/109104326208920610071/+GreenmarketUaUa/posts" >
                                <span class="social-links-img social-google"></span>
                            </a>

                    </div>

                </div>

                <div class="col-lg-5 footer-block footer-cat-block">

                    <div class="row align-items-center">

                        <div class="footer-logo footer-logo-cat-image"></div>

                        <div class="col-md-12">
                            <h5 class="footer-cat-title">Рубрики</h5>
                        </div>

                        <div class="col-md-12 js-footer-categories">

                            <?php
                            $filename_category_footer = get_template_directory() . '/cache/category_footer_template.php';

                            if (file_exists($filename_category_footer)) {

                                require $filename_category_footer;

                            }else{
                                get_categories_menu('', 'footer_cat_list', 'col-xs-12 col-sm-6', 'justify-content-start', false);
                            } ?>
                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4 footer-block footer-rules-block">

                    <div class="row align-items-center justify-content-center footer-rules-block-outer ">

                        <div class="footer-logo footer-logo-shop-image"></div>

                        <div class="col-lg-12">
                            <a class="d-flex justify-content-left footer-rules-link" href="<?php echo GM_SHOP_URL . 'upakovka.html' ?>" >
                                <span class="footer-rules-img footer-package"></span>
                                <span class="d-flex align-self-center footer-rules-link-text">Профессиональная упаковка!</span>
                            </a>
                        </div>

                        <div class="col-lg-12">
                            <a class="d-flex justify-content-left footer-rules-link" href="<?php echo GM_SHOP_URL . 'garanty.html' ?>" >
                                <span class="d-flex footer-rules-img footer-waranty"></span>
                                <span class="d-flex align-self-center footer-rules-link-text">Гарантия на качество посадматериала!</span>
                            </a>
                        </div>

                        <div class=" col-lg-12">
                            <a class="d-flex justify-content-left footer-rules-link" href="<?php echo GM_SHOP_URL . 'dostavka.html' ?>" >
                                <span class="d-flex footer-rules-img footer-payment"></span>
                                <span class="d-flex align-self-center footer-rules-link-text">Оплата при получении!</span>
                            </a>
                        </div>

                        <div class="col-lg-12">
                            <a class="d-flex justify-content-left footer-rules-link" href="<?php echo GM_SHOP_URL . 'dostavka.html' ?>" >
                                <span class="d-flex footer-rules-img footer-delivery"></span>
                                <span class="d-flex align-self-center footer-rules-link-text">Доставка в любую точку Украины!</span>
                            </a>
                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-2 footer-block footer-shop-block">

                    <div class="row footer-shop-block-outer ">

                        <div class="col-md-12 align-self-center">
                           <div class="ml-auto mr-auto text-center footer-shop-btn-outer">
                                <a href="<?php echo GM_SHOP_URL; ?>" class="btn btn-gm " id="js-btn-footer-shop" role="button" onclick="_gaq.push(['_trackEvent', 'perechod', 'vmagazin', 'footer']);">
                                    В МАГАЗИН
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="row align-items-center no-gutters footer-row-second">


                <div class="col-md-5 footer-title-form-block ">

                    <div class="footer-logo footer-logo-subscribe-image"></div>

                    <h6 class="footer-title-form">Подписаться на обновление блога</h6>

                </div>

                <div class="col-md-7 footer-form-block ">

                    <form class="form-inline footer-form-subscribe js-subscribe">

                        <div class="form-row row w-100 no-gutters">

                            <div class="col-md-6 col-lg-8 footer-form-col">

                                <input type="text" name="subscribe_name" id="subscribe_name_footer" class="d-flex w-100  form-control footer-input" placeholder="Ваше имя">

                                <input type="text" name="subscribe_email" id="subscribe_email_footer" class="d-flex w-100  form-control footer-input" placeholder="E-mail">


                            </div>

                            <div class="col-md-6 col-lg-4 text-sm-center text-md-right footer-form-col">

                                <button type="submit" class="form-control h-100 btn btn-gm btn-gm-white"
                                        id="js-btn-footer-subscribe"
                                        onclick="_gaq.push(['_trackEvent', 'blog', 'click', 'podpisatsya']);">
                                    ПОДПИСАТЬСЯ
                                </button>

                            </div>

                        </div>

                    </form>

                </div>
            </div>


            <div class="row footer-row-third">
                <div class="col-md-12 footer-copyright-block ">
                    <p class="text-center">
                        <?php echo 'Copyright © 2010-' . date("Y") . ' GreenMarket'; ?>

                    </p>
                </div>
            </div>



		</div><!--  .container -->

        <div class="footer-bg-helper-line"></div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Social plugins links -->
<!--<script src="https://apis.google.com/js/platform.js" async defer>
    {lang: 'ru'}
</script>

<script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script>-->

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php wp_footer(); ?>

<!-- Код тега ремаркетинга Google -->
<!--------------------------------------------------
С помощью тега ремаркетинга запрещается собирать информацию, по которой можно идентифицировать личность пользователя. Также запрещается размещать тег на страницах с контентом деликатного характера. Подробнее об этих требованиях и о настройке тега читайте на странице http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
    var google_tag_params = {

        ecomm_pagetype: 'other'
    };

</script>
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 976407332;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
    <div>
        <img height="1" width="1" alt="googleads" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/976407332/?value=0&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

</body>
</html>
