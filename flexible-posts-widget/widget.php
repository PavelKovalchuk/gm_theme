<?php
/**
 * Flexible Posts Widget: Default widget template
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');


if ( !empty($title) ){ ?>

    <div class="row no-gutters" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-12">
            <h4 class="sidebar-block-title popular-posts-list-title" ><?php echo $title ; ?></h4>
        </div>
    </div>

<?php } ?>

<?php if( $flexible_posts->have_posts() ): ?>


    <div class="row no-gutters popular-posts-container-inner popular-posts">

        <!--<div class="col-lg-12">-->

    <?php while( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>

            <!--<div class="row no-gutters popular-post-outer">-->

                <div class="col-md-6 col-lg-12 popular-post-inner">

                    <a class="d-flex popular-post-title-link" href="<?php echo get_the_permalink(); ?>">
                        <span class="popular-post-title"><?php the_title(); ?></span>
                    </a>




                    <figure class="d-flex popular-post-img-outer" >
                        <?php
                        if( $thumbnail == true ) {
                            // If the post has a feature image, show it
                            if( has_post_thumbnail() ) {
                                the_post_thumbnail( $thumbsize );
                                // Else if the post has a mime type that starts with "image/" then show the image directly.
                            } elseif( 'image/' == substr( $post->post_mime_type, 0, 6 ) ) {
                                echo wp_get_attachment_image( $post->ID, $thumbsize );
                            }
                        }
                        ?>

                        <figcaption class="popular-post-img-hover ">
                            <a href="<?php echo get_the_permalink(); ?>" class="popular-post-img-link ">
                                <span class="popular-post-img-text">Читать далее</span>
                            </a>
                        </figcaption>

                    </figure>



                </div>

            <!--</div>-->

    <?php endwhile; ?>

        <!--</div>-->


    </div>




<?php else: // We have no posts ?>
	<div class="dpe-flexible-posts no-posts">
		<p><?php _e( 'No post found', 'flexible-posts-widget' ); ?></p>
	</div>
<?php
endif; // End have_posts()
