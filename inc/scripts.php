<?php
/**
 * Enqueue scripts and styles.
 */
function gm_scripts() {
	wp_enqueue_style( 'gm-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_theme_file_path('/style.css') ) );

    wp_deregister_script( 'jquery' );


    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '3.2.1', true );

    wp_enqueue_script( 'gm-js', get_template_directory_uri() . '/build/js/main.min.js', array('jquery'), filemtime( get_theme_file_path('/build/js/main.min.js')), true );

	//wp_enqueue_script( 'gm-js', get_template_directory_uri() . '/build/js/main.min.js#asyncload', array('jquery'), '1.0.0', true );

    wp_enqueue_script( 'form-handler', get_template_directory_uri() . '/js/form_handler.js#asyncload', array('jquery'), '1.0.0', true );
	//For displaying connected products

    $post_id = 0;
    $productsPost  = [];


    if(function_exists('pk_cpp_get_connected_products') && is_singular(['post'])){
        $post_id = get_the_ID();
        $productsPost  = pk_cpp_get_connected_products($post_id);
    }

    $data_array = array(
        'mainSiteBasePath' => GM_SHOP_URL,
        // 'productsPost' => json_encode($productsPost),
        'productsPost' => $productsPost,
        'postID' => $post_id,
        'ajaxUrl' => admin_url('admin-ajax.php')

    );
    wp_localize_script( 'gm-js', 'BLOGDATA', $data_array );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


}
add_action( 'wp_enqueue_scripts', 'gm_scripts', 200 );


// Async load
function gm_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
        return str_replace( '#asyncload', '', $url )."' async='async";
}
add_filter( 'clean_url', 'gm_async_scripts', 11, 1 );