<?php

// регистрируем  интервал
add_filter( 'cron_schedules', 'category_footer_template_event' );
add_filter( 'cron_schedules', 'category_sidebar_template_event' );

function category_footer_template_event( $schedules ) {
    $schedules['category_footer_time'] = array(
        'interval' => 86400,
        'display' => 'Once in 24 hours for categories template in footer'
    );

    return $schedules;
}

function category_sidebar_template_event( $schedules ) {

    $schedules['category_sidebar_time'] = array(
        'interval' => 86400,
        'display' => 'Once in 24 hours for categories template in sidebar'
    );

    return $schedules;
}



// регистрируем событие
add_action('wp', 'category_template_register');

function category_template_register() {

    if ( ! wp_next_scheduled( 'category_footer_template_update' ) ) {

        wp_schedule_event( time(), 'category_footer_time', 'category_footer_template_update');

    }

    if ( ! wp_next_scheduled( 'category_sidebar_template_update' ) ) {

        wp_schedule_event( time(), 'category_sidebar_time', 'category_sidebar_template_update');

    }

}


// Будет грамотно проверить выполняется ли крон, если нет - ничего не делаем
// Можно не проводить эту проверку, в принципе

//Тут мы создаем файлы шаблонов
if( defined('DOING_CRON') && DOING_CRON ){
    // добавляем функцию к указанному хуку
    add_action('category_footer_template_update', 'do_category_footer_template');

    function do_category_footer_template() {

        $response = get_categories_menu_string('', 'footer_cat_list', 'col-xs-12 col-sm-6', 'justify-content-start', 'false');

        $file_template = get_stylesheet_directory() ."/cache/category_footer_template.php";

        file_put_contents($file_template, $response );

        //wp_pk_cron_log( "DONE: category_footer_template");

    }

    add_action('category_sidebar_template_update', 'do_category_sidebar_template');

    function do_category_sidebar_template() {

        $response = get_categories_menu_string('no-gutters collapse show ', 'collapseCategories', 'sidebar_cat_item col-md-12', 'justify-content-between', 'true');

        $file_template = get_stylesheet_directory() ."/cache/category_sidebar_template.php";

        file_put_contents($file_template, $response );

        //wp_pk_cron_log( "DONE: category_sidebar_template");

    }
}


function  wp_pk_cron_log( $string) {

    $logFileName = get_stylesheet_directory() ."/logs/cron_logs.txt";

    $currtime = (new DateTime())->format('Y-m-d H:i:s');

    file_put_contents($logFileName,"$currtime: $string\n", FILE_APPEND);
}
