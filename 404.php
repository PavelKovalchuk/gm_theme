<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

                        <main id="main" class="row w-100 no-gutters site-main " >

                            <div class="col-lg-12">

                                <div class="row no-gutters">

                                    <div class="col-lg-12 entry-blog-page blog-page-title-outer">

                                        <h1 class="entry-blog-page-title blog-page-title">
                                            СТРАНИЦА НЕ НАЙДЕНА
                                        </h1>


                                    </div>


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
