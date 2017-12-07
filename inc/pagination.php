<?php

/*******************************************************************
 * @Author: Boutros AbiChedid
 * @Date:   March 20, 2011
 * @Websites: http://bacsoftwareconsulting.com/
 * http://blueoliveonline.com/
 * @Description: Numbered Page Navigation (Pagination) Code.
 * @Tested: Up to WordPress version 3.1.2 (also works on WP 3.3.1)
 ********************************************************************/

/* Function that Rounds To The Nearest Value.
   Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
    /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
    return floor($num/$to_nearest)*$to_nearest;
}

/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
function kp_pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
    $pagenavi_options['pages_text'] = ('');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('К первой странице');
    $pagenavi_options['last_text'] = ('К последней странице');
    $pagenavi_options['next_text'] = '<img src="' . get_stylesheet_directory_uri() . '/build/img/next_arrow.png' . '" class="page-numbers-img" alt="Следущая страница" data-toggle="tooltip" data-placement="top"  title="Следущая страница" />';
    $pagenavi_options['prev_text'] = '<img src="' . get_stylesheet_directory_uri() . '/build/img/prev_arrow.png' . '" class="page-numbers-img" alt="Предыдущая страница" data-toggle="tooltip" data-placement="top" title="Предыдущая страница"/>';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
    $pagenavi_options['item_classes'] = 'd-inline-flex justify-content-center align-items-center page-numbers ';


    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
    if (!is_single()) {
        $request = $wp_query->request;
        //intval — Get the integer value of a variable
        /*http://php.net/manual/en/function.intval.php*/
        $posts_per_page = intval(get_query_var('posts_per_page'));
        //Retrieve variable in the WP_Query class.
        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;

        //empty — Determine whether a variable is empty
        /*http://php.net/manual/en/function.empty.php*/
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }

        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;

        if($start_page <= 0) {
            $start_page = 1;
        }

        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }

        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        //round_num() custom function - Rounds To The Nearest Value.
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);

        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            /*http://php.net/manual/en/function.str-replace.php */
            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="row no-gutters justify-content-between justify-content-sm-center align-items-center pagenavi ">'."\n";

            if(!empty($pages_text)) {
                echo '<span class="pages">'.$pages_text.'</span>';
            }
            //Displays a link to the previous post which exists in chronological order from the current post.
            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/



            //FIRST PAGE START
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
                /*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.

                 echo '<span class="' . $pagenavi_options['item_classes'] . 'page-numbers-first-page" >';
                    echo '<a href="'.esc_url(get_pagenum_link()).'" class="pagin-link" data-toggle="tooltip" data-placement="top" title="'.$first_page_text.'">'
                        .'<img src="' . get_stylesheet_directory_uri() . '/build/img/first_arrow.png' . '" class="page-numbers-img" alt="Первая страница"/>'
                        . '</a>';
                 echo '</span>';

                if(!empty($pagenavi_options['dotleft_text'])) {
                    //DOTS PAGE START
                    //echo '<span class="' . $pagenavi_options['item_classes'] . ' page-numbers-dots" >';
                        //echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                    //echo '</span>';
                    //DOTS PAGE END
                }
            }
            //FIRST PAGE END

            //PREV PAGE START
            if($start_page > 1){
                echo '<span class="' . $pagenavi_options['item_classes'] . 'page-numbers prev-page" >';
                previous_posts_link($pagenavi_options['prev_text']);
                echo '</span>';
            }

            //PREV PAGE END

            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<span class="' . $pagenavi_options['item_classes'] . '" >';
                        echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="pagin-link" data-toggle="tooltip" data-placement="top" title="'.$page_text.'">'.$page_text.'</a>';
                    echo '</span>';
                }
            }

            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);

                    //CURRENT PAGE START
                    echo '<span class="' . $pagenavi_options['item_classes'] . ' page-numbers-current" data-toggle="tooltip" data-placement="top" title="Активная страница" >';
                        echo '<span  class="current">'.$current_page_text.'</span>';
                    echo '</span>';
                    //CURRENT PAGE END

                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    //SIMPLE PAGE START
                    echo '<span class="' . $pagenavi_options['item_classes'] . ' page-numbers-simple" data-toggle="tooltip" data-placement="top" title="'.$page_text.'" >';
                        echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="pagin-link" >'.$page_text.'</a>';
                    echo '</span>';
                    //SIMPLE PAGE END
                }
            }



            //NEXT PAGE START
            echo '<span class="' . $pagenavi_options['item_classes'] . ' next-page" >';
                next_posts_link($pagenavi_options['next_text'], $max_page);
            echo '</span>';
            //NEXT PAGE END

            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    //DOTS PAGE START
                    //echo '<span class="' . $pagenavi_options['item_classes'] . ' page-numbers-dots" >';
                        //echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                    //echo '</span>';
                    //DOTS PAGE END
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);

                //LAST PAGE START
                echo '<span class="' . $pagenavi_options['item_classes'] . ' page-numbers-last-page" >';
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" data-toggle="tooltip" data-placement="top" class="pagin-link" title="'.$last_page_text.'">'
                    .'<img src="' . get_stylesheet_directory_uri() . '/build/img/last_arrow.png' . '" class="page-numbers-img" alt="Последняя страница" />'
                    .'</a>';
                echo '</span>';
                //LAST PAGE END
            }

            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class=" pagin-link" title="'.$page_text.'" data-toggle="tooltip" data-placement="top" >'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}