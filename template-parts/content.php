<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package StrapPress
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-lg-12 js_post_item <?php echo join(' ', get_post_class() ); ?> " >

    <div class="row no-gutters post-container-outer <?php if(is_singular(array('post'))){ echo 'shadow-block ';} ?>">

        <div class="col-lg-12 post-container-inner">



            <header class="row no-gutters entry-header article-title-outer">

                <div class="col-lg-12">
                <?php

                if ( is_single() ) :
                    the_title( '<h1 class="entry-title article-title article-title-single">', '</h1>' );
                else :
                    the_title( '<h2 class="entry-title article-title "><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="article-title-link" >', '</a></h2>' );
                endif;

                ?>
                </div>

            </header><!-- .entry-header -->



            <?php if ( has_post_thumbnail() && is_single() ) : ?>

                <div class="row no-gutters post-thumbnail">
                    <div class="col-lg-12 js-share-parent js-share-disable single-thumbnail-container">

                        <?php the_post_thumbnail('post-main-image', array('class' => 'js_post_item_img rounded')); ?>

                        <?php get_share_buttons('justify-content-around'); ?>
                    </div>

                </div><!--  .post-thumbnail -->

            <?php else : ?>

                 <div class="row no-gutters post-thumbnail">
                     <div class="col-lg-12 js-share-parent">
                         <a href="<?php the_permalink(); ?>" class=" post-thumbnail-link" title="<?php the_title_attribute(); ?>">

                             <?php the_post_thumbnail('post-main-image', array('class' => 'js_post_item_img rounded')); ?>

                         </a>

                         <?php //get_share_buttons(); ?>
                         <?php get_share_buttons('justify-content-start archive-share-buttons'); ?>


                     </div>
                 </div><!--  .post-thumbnail -->

            <?php endif; ?>


            <?php if ( 'post' === get_post_type() ) : ?>



                <div class="row no-gutters entry-meta">
                    <div class="col-lg-12">
                        <?php strappress_posted_on(); ?>
                    </div>
                </div><!-- .entry-meta -->

                <?php
             endif; ?>


            <div class="row no-gutters entry-content">
                <div class="col-lg-12">

                <?php
                    the_content( sprintf(
                        /* translators: %s: Name of current post. */
                        wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gm_wp' ), array( 'span' => array( 'class' => array() ) ) ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                    ) );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gm_wp' ),
                        'after'  => '</div>',
                    ) );

                if ( is_single() ){
                    get_posts_tags('Теги: ');
                }
                ?>

                </div>
            </div><!-- .entry-content -->




            <?php
            if ( is_single() && (comments_open() || get_comments_number() ) ) :

                get_recommended_products_block('Рекомендуемые товары:', 'Перейти в каталог');

                get_related_posts_block('Читайте также:');

                get_comments_block('Комментарии:');

            endif; ?>


            <footer class="row no-gutters entry-footer">
                <?php strappress_entry_footer(); ?>

            </footer><!-- .entry-footer -->

        </div>

    </div>

</article><!-- #post-## -->
