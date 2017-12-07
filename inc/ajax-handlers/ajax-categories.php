<?php
/**
 * Created by PhpStorm.
 * User: pkovalchuk
 * Date: 04.12.2017
 * Time: 14:31
 */

function blog_categories_ajax_handler(){
    // prepare our arguments for the query
    //$data_args = json_decode( stripslashes( $_POST ), true );
    //var_dump($_POST['cat_outer_class']);die;

    $cat_outer_class = stripslashes($_POST['cat_outer_class']);
    $cat_outer_id = stripslashes($_POST['cat_outer_id']);
    $cat_class = stripslashes($_POST['cat_class']);
    $cat_link_class = stripslashes($_POST['cat_link_class']);
    $show_numbers = stripslashes($_POST['show_numbers']);



    $response = get_categories_menu_string($cat_outer_class, $cat_outer_id, $cat_class, $cat_link_class, $show_numbers);


    echo json_encode($response);
    die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_categories', 'blog_categories_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_categories', 'blog_categories_ajax_handler'); // wp_ajax_nopriv_{action}




function get_categories_menu_string($cat_outer_class = '', $cat_outer_id = '', $cat_class="col", $cat_link_class = 'justify-content-start', $show_numbers = false){

    $args = array(
        'type'         => 'post',
        'child_of'     => 0,
        'parent'       => '',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'hierarchical' => 1,
        'exclude'      => '',
        'include'      => '',
        'number'       => 0,
        'taxonomy'     => 'category',
        'pad_counts'   => false,
        // полный список параметров смотрите в описании функции http://wp-kama.ru/function/get_terms
    );
    $gm_categories = get_categories( $args );

    usort($gm_categories,'sort_categories');

    if( $gm_categories ){

        if($cat_outer_id){
            $id_data = ' id="' . $cat_outer_id . '" ';
        }else{
            $id_data = '';
        }

        $html = '<div class="row categories_list_outer ' . $cat_outer_class . '"' . $id_data . '>';



        $count_posts = wp_count_posts();

        $published_posts = $count_posts->publish;

        $html .= get_cat_link_template_ajax(false, 'Все статьи', $published_posts, $cat_class, $cat_link_class, $show_numbers);

        foreach( $gm_categories as $category ){

            $html .= get_cat_link_template_ajax($category->term_id, $category->cat_name, $category->category_count, $cat_class, $cat_link_class, $show_numbers);

        }


        $html .= '</div>';

    }

    return $html;

}

function get_cat_link_template_ajax($term_id, $cat_name, $category_count, $cat_class="col", $cat_link_class = 'justify-content-start', $show_numbers = false){


    $html = '<div class="' . $cat_class . '" >';

    if(intval($term_id)){
        $link = get_category_link( $term_id );
    }else{
        $link = get_site_url();
    }

    $html .= '<a class="d-flex ' . $cat_link_class .  ' cat_link" href="' .  $link . '">';

    $html .= '<span class="cat_link_text">' . $cat_name . '</span>';

    if($show_numbers == 'true'){

        $html .= '<span class="cat_counter_outer"><span class="badge cat_counter">' .$category_count . '</span></span>';

    }

    $html .= '</a>';

    $html .= '</div>';

    return $html;
}