<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package StrapPress
 */

get_header(); ?>

    <div class="container main-content-container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row no-gutters">

                    <aside id="sidebar" class="d-flex sidebar-container" role="complementary">

                        <div class="row h-100 no-gutters sidebar-container-innner">

                            <div class="col-lg-12">

                                <div class="row">
                                    <?php get_sidebar(); ?>
                                </div>

                            </div>

                        </div>

                    </aside>


                    <div id="primary" class="d-flex articles-area bg-white ">
                        <!--<div id="primary" class="content-area">-->
                        <main id="main" class="row w-100 no-gutters site-main ">

                            <div class="col-lg-12">

                                <div class="row no-gutters">



                                    <?php
                                    if ( have_posts() ) :


                                         if( is_search() ): ?>

                                            <div class="col-lg-12 entry-blog-page blog-page-title-outer">

                                                <?php  if(!empty($_GET['s'])){
                                                    $key_word = $_GET['s'];
                                                }
                                                ?>

                                                <?php if($key_word) { ?>
                                                <header>
                                                    <h1 class="entry-blog-page-title blog-page-title">
                                                        <?php echo 'Результаты поиска по: <i>"' . $key_word . '"</i>'; ?>
                                                    </h1>
                                                </header>
                                                <?php } ?>

                                            </div>


                                        <?php endif;

                                        /* Start the Loop */
                                        while ( have_posts() ) : the_post();

                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                            get_template_part( 'template-parts/content', get_post_format() );

                                        endwhile;


                                        ?>
                                        <div class="col-lg-12 entry-blog-pagenavi pagenavi-outer">

                                            <?php kp_pagenavi(); ?>

                                        </div>
                                        <?php

                                    else :

                                        get_template_part( 'template-parts/content', 'none' );

                                    endif; ?>

                                </div>
                            </div>

                        </main><!-- #main -->

                    </div><!-- #primary -->

                </div>

            </div>

        </div><!--  .row -->

    </div><!--  .container -->

<?php

get_footer();
