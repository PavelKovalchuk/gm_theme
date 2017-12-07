<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function strappress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'strappress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'strappress' ),
		'before_widget' => '<section id="%1$s" class="widget card %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title card-header">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'strappress_widgets_init' );





function gm_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'greenmarket_blog' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar that appears on the left.', 'greenmarket_blog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Content Sidebar', 'greenmarket_blog' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Additional sidebar that appears on the right.', 'greenmarket_blog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'greenmarket_blog' ),
        'id'            => 'sidebar-3',
        'description'   => __( 'Appears in the footer section of the site.', 'greenmarket_blog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Popular Posts Area', 'greenmarket_blog' ),
        'id'            => 'popular-posts',
        'description'   => __( 'Popular posts in sidebar (Index page and category page)', 'greenmarket_blog' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'gm_widgets_init' );

