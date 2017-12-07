<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package StrapPress
 */

get_header(); ?>

    <div class="container main-content-container single-container">

        <div class="row">

            <div class="col-lg-12">

                <div class="row no-gutters">



                    <div id="primary" class="d-flex w-100 bg-white ">

                        <main id="main" class="row w-100 no-gutters site-main ">

                            <div class="col-lg-12">

                                <div class="row ">

                                    <?php the_breadcrumb(); ?>


                                    <?php while ( have_posts() ) : the_post();

                                        get_template_part( 'template-parts/content', get_post_format() );

                                        //the_post_navigation();
                                    endwhile; // End of the loop. ?>




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


