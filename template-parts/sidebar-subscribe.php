<?php
?>

<div id="sidebar_subscribe" class="col-lg-12 sidebar-subscribe-container" role="complementary">

    <div class="row no-gutters sidebar-subscribe-container-inner">
        <div class="col-lg-12">

            <div class="row no-gutters">
                <div class="col-lg-12 sidebar-subscribe-img-outer">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/build/img/gm_subscribe_sidebar_icon.png" alt="subscribe" class="sidebar-subscribe-img" />
                </div>
            </div>


            <div class="row no-gutters">
                <div class="col-lg-12">
                    <h4 class="subscribe-form-title" >
                        Подписаться <br> на обновление блога
                    </h4>
                </div>
            </div>


            <form class="form sidebar-form-subscribe js-subscribe" name="subscribe-form-sidebar">

                <div class="form-row row w-100 no-gutters">

                    <div class="col-lg-12 sidebar-form-col">


                        <input type="text" name="subscribe_name" id="subscribe_name" class="d-flex w-100  form-control sidebar-input" placeholder="Ваше имя">

                        <input type="text" name="subscribe_email" id="subscribe_email" class="d-flex w-100  form-control sidebar-input" placeholder="E-mail">

                        <button type="submit" class="form-control btn btn-gm btn-gm-white btn-gm-subscribe"
                                id="js-btn-sidebar-subscribe"
                                onclick="_gaq.push(['_trackEvent', 'blog', 'click', 'podpisatsya']);">
                            ПОДПИСАТЬСЯ
                        </button>


                    </div>


                </div>

            </form>

        </div>
    </div>

</div>


