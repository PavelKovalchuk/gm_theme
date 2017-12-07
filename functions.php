<?php
/**
 * StrapPress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package StrapPress
 */


/** Абсолютный путь к магазину GreenMarket. */


if ( !defined('GM_SHOP_URL') ){
    define('GM_SHOP_URL', get_option('gm_shop_url') );
}


/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);

if ( ! function_exists( 'gm_wp_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function gm_wp_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on StrapPress, use a find and replace
         * to change 'strappress' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'gm_wp', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size( 'category-post-image', 672, 360, true );
        add_image_size( 'post-main-image', 973, 500, true );

        add_image_size( 'size-645-459', 645, 459, true );
        add_image_size( 'size-318-459', 318, 459, true );
        add_image_size( 'big-973-500', 972, 499, true );

        add_image_size( 'two-images-1', 642, 393, true );
        add_image_size( 'two-images-2', 317, 393, true );

        add_image_size( 'three-images-1', 317, 393, true );
        add_image_size( 'three-images-2', 317, 393, true );
        add_image_size( 'three-images-3', 317, 393, true );


        add_image_size( 'popular-posts', 230, 120, true );


        add_image_size( 'related-post-thumbnail', 220, 165, true );

        add_image_size( 'popular-post-image', 230, 121, true );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary'   => esc_html__( 'Top primary menu', 'gm_wp' ),
            'categories' => __( 'Categories in left sidebar', 'greenmarket_blog' ),
        ) );

        // This theme uses wp_nav_menu() in one location.
        /*register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'gm_wp' ),
        ) );*/

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'strappress_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action( 'after_setup_theme', 'gm_wp_setup' );



/**
регистрируем опцию URL адреса магазина - Константа GM_SHOP_URL

*/
function add_url_option_field_to_general_admin_page(){
    $option_name = 'gm_shop_url';

    // регистрируем опцию
    register_setting( 'general', $option_name );

    // добавляем поле
    add_settings_field(
        'gm_shopUrl_setting-id',
        'GM_SHOP_URL - Константа для кода- Адресс магазина GreenMarket',
        'gm_shopUrl_setting_callback_function',
        'general',
        'default',
        array(
            'id' => 'gm_shopUrl_setting-id',
            'option_name' => 'gm_shop_url'
        )
    );
}
add_action('admin_menu', 'add_url_option_field_to_general_admin_page');

function gm_shopUrl_setting_callback_function( $val ){
    $id = $val['id'];
    $option_name = $val['option_name'];
    ?>
    <input
        type="text"
        class="regular-text code"
        name="<?php echo $option_name; ?>"
        id="<?php echo $id; ?>"
        value="<?php echo esc_attr( get_option($option_name) ); ?>"
    />
    <?php
}



function true_russian_date_forms($the_date = '') {
    if ( substr_count($the_date , '---') > 0 ) {
        return str_replace('---', '', $the_date);
    }
    $replacements = array(
        "Январь" => "января",
        "Февраль" => "февраля",
        "Март" => "марта",
        "Апрель" => "апреля",
        "Май" => "мая",
        "Июнь" => "июня",
        "Июль" => "июля",
        "Август" => "августа",
        "Сентябрь" => "сентября",
        "Октябрь" => "октября",
        "Ноябрь" => "ноября",
        "Декабрь" => "декабря"
    );
    return strtr($the_date, $replacements);
}
/*add_filter('the_time', 'true_russian_date_forms');
add_filter('get_the_time', 'true_russian_date_forms');
add_filter('the_date', 'true_russian_date_forms');
add_filter('get_the_date', 'true_russian_date_forms');
add_filter('the_modified_time', 'true_russian_date_forms');
add_filter('get_post_time', 'true_russian_date_forms');
add_filter('get_comment_date', 'true_russian_date_forms');*/

add_filter('get_the_modified_date', 'true_russian_date_forms');



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function strappress_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'strappress_content_width', 640 );
}
add_action( 'after_setup_theme', 'strappress_content_width', 0 );


/**
 * Add CSS/JS Scritps
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * template functions
 */
require get_template_directory() . '/template-parts/html-parts.php';

/**
 * Register Widget Areas
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions pagination.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions pagination.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Bootstrap Walker.
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

/**
 * Custom ajax handler
 */
require get_template_directory() . '/inc/ajax-handlers/ajax-categories.php';

/*CRON jobs*/

require get_template_directory() . '/inc/cron-tasks/cron-categories-tasks.php';
