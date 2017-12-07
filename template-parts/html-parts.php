<?php


function get_main_slider(){

    ?><!-- Main slider start-->
<?php

$query = new wpdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);
$banners = $query->get_results('(SELECT banner_id as id, b.type,  b.image as image, c.categories_url as url
FROM banner as b
LEFT JOIN categories as c ON c.categories_id=b.categories_id
WHERE b.status=1 and b.type=1
ORDER BY b.sort)
UNION
(SELECT b.banner_id as id, b.type, b.image as image, cm.content_page_url as url
FROM banner as b
JOIN content_manager as cm ON cm.content_group=b.categories_id
WHERE b.status=1 and b.type=2
ORDER BY b.sort)');
foreach($banners as $ban){
    $cur_image = $ban->image;
    if(trim($cur_image)){
        $ban_arr[] = array('id'=> $ban->id, 'image'=> $cur_image, 'url'=> $ban->url);
    }
}

//var_dump($ban_arr);
?>

<?php if ( count($ban_arr) > 0){ ?>

    <div class="slider-container js-main-slider" id="mainSlider">

        <?php foreach ($ban_arr  as $cur_ban){ ?>
            <div id="card-<?php echo $cur_ban['id']; ?>" class="slider-card card-<?php echo $cur_ban['id']; ?>" style="background-image: url(<?php echo bloginfo('template_url') . '/images/banners/blurred/' . $cur_ban['image']; ?>); background-size: cover;">

                <div class="slider-gradient-left"></div>

                <div class="slider-gradient-right"></div>

                <div class="container slider-image-container">

                    <div class="row no-gutters">

                        <div class="col-md">

                            <div class="card-bg" style="background-image: url(<?php echo bloginfo('template_url') . '/images/banners/' . $cur_ban['image']; ?>);" data-initial-width="1008" data-initial-height="217">
                                <a href="<?php echo GM_SHOP_URL . $cur_ban['url']; ?>" class="slider-link"  ></a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        <?php } ?>


    </div>




<?php } ?>

    <!-- Main slider start-->
<?php
}

function get_posts_tags($title){

    ?><div class="block-post-tag-container"><?php

    if( get_the_tag_list() ){

        if ($title) {
            ?><h5 class="block-post-tag-list-title"><?php echo $title; ?></h5>
            <?php
        }

        echo get_the_tag_list('<div class="block-post-tag-list"><span class="block-post-tag-item">','</span>, <span class="block-post-tag-item">','</span></div>');
    }

    ?></div><?php

}


function get_related_posts_block($title){

    ?>

    <!-- Related posts block start-->
    <div class="row no-gutters js-related-posts-block block-padding related-posts-container" >

        <?php if ($title){ ?>
            <div class="col-lg-12 block-title related-posts-title-outer">
                <h3 class="related-posts-title">
                    <?php echo $title; ?>
                </h3>
            </div>
        <?php } ?>

        <div class="row no-gutters w-100">

            <div class="col-lg-12">

                <div class="row related-posts-content">

                    <div class="d-inline-flex d-xl-flex related-posts-items-outer">

                        <div class="related-posts">

                            <script id="KMfHH6JjQrhCoqKi"> if(window.relap){ window.relap.ar('KMfHH6JjQrhCoqKi');}else{console.log('No Relap');}  </script>

                            <div class="clear"></div>


                        </div>


                    </div>

                    <div class="d-inline-flex d-xl-flex related-posts-subscribe-outer">

                        <?php theme_sidebar('subscribe'); ?>

                    </div>

                </div>

            </div>



        </div>




    </div>

    <!-- Related posts block end-->

    <?php
}


function get_recommended_products_block($title, $button){

    ?>

    <!-- Recommended products block start-->

    <div class="row no-gutters js-product-slider block-padding products-slider-container" data-post-id="<?php echo get_the_ID(); ?>">

        <?php if ($title){ ?>
            <div class="col-lg-12 products-slider-title-outer">
                <h3 class="block-title products-slider-title">
                    <?php echo $title; ?>
                </h3>
            </div>
        <?php } ?>

        <div class="col-lg-12 products-slider-items-outer">

            <div class="row no-gutters products-slider-inner">

                <div class="d-inline-flex d-sm-flex justify-content-center products-slider-nav  products-slider-nav-prev ">
                    <span class="d-flex  align-self-start align-self-sm-center products-slider-nav-img prev"></span>
                </div>

                <div class="col products-slider-items" id="products-slider-items"></div>

                <div class="d-inline-flex d-sm-flex justify-content-center products-slider-nav  products-slider-nav-mext">
                    <span class="d-flex  align-self-start align-self-sm-center products-slider-nav-img next"></span>
                </div>


            </div>

        </div>

        <?php if ($button){ ?>
        <div class="col-lg-12 text-center products-slider-footer-outer">
            <a href="<?php echo GM_SHOP_URL; ?>" class="btn btn-gm btn-gm-middle" id="js-btn-go-shop-recommended" role="button">
                Перейти в каталог
            </a>
        </div>
        <?php } ?>


    </div>



    <!-- Recommended products block end-->

    <?php

}

function get_comments_block($title){

    ?>

    <!-- Comments block start-->
    <div class="row no-gutters block-padding disqus-container">

        <?php if ($title){ ?>
            <div class="col-lg-12 comments-title-outer">
                <h3 class="block-title comments-title">
                    <?php echo $title; ?>
                </h3>
            </div>
        <?php } ?>


        <div class="col-lg-12 disqus-inner">
            <?php comments_template(); ?>
        </div>
    </div>
    <!-- Comments block end-->

    <?php

}

/**
 * You should add class js-share-parent to the parent element of the image
 */
function get_share_buttons($classes){

    ?>
    <!-- Share buttons block start-->

    <div class="row no-gutters <?php echo $classes; ?> align-items-center post-share-block js-article-share">

        <!--<div class="col-lg-12  post-share-inner js-article-image-share">-->

            <div class="d-flex share-item share-item-fb">
                <span class="d-flex js-button share-item-btn fb" data-provider="fb">
                    <span class="social-links-img social-fb"></span>
                </span>
            </div>

            <div class="d-flex share-item share-item-twitter" >
                <span class="d-flex js-button share-item-btn tw" data-provider="tw">
                    <span class="social-links-img social-twitter"></span>
                </span>
            </div>

            <div class="d-flex share-item share-item-google">
                <span class="d-flex js-button share-item-btn gp" data-provider="gp">
                    <span class="social-links-img social-google"></span>
                </span>
            </div>

       <!-- </div>-->

    </div>
    <!-- Share buttons block end-->

    <?php
}


function get_share_buttons_2(){

    ?>


    <div class="row no-gutters justify-content-start align-items-center post-share-block">

        <!--<div class="col-lg-12 post-share-block-inner">-->

            <div class="d-flex share-item share-item-fb">
                <div class="fb-share-button" data-href="https:<?php echo get_permalink(); ?>" data-layout="button" data-show-faces="true" data-share="true"></div>
                <div id="fb-root"></div>
            </div>

            <div class="d-flex share-item share-item-twitter" >
                <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo get_the_title(); ?>" data-url="https:<?php echo get_permalink(); ?>" data-count='none'>Tweet</a>
            </div>

            <div class="d-flex share-item share-item-google">

                <div class="g-plusone" data-action="share" data-size="medium" data-annotation="none"  data-href="https:<?php echo get_permalink(); ?>"></div>

            </div>


        <!--</div>-->


    </div>

<?php
}

function the_breadcrumb() {
    ?>
    <div class="container breadcrumb_container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_nav" aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb" id="breadcrumb">

                        <?php
                        if (!is_home()) {

                            echo '<li class="breadcrumb-item" ><a href="';
                            echo GM_SHOP_URL;
                            echo '">';
                            echo 'Главная';
                            echo "</a></li>";


                            echo '<li class="breadcrumb-item" ><a href="';
                            echo get_option('home');
                            echo '">';
                            echo 'Блог';
                            echo "</a></li>";

                            if (is_category() || is_single()) {
                                echo '<li class="breadcrumb-item" >';
                                the_category(' </li><li> ');
                                if (is_single()) {
                                    echo "</li><li class='breadcrumb-item' aria-current='page'>";
                                    echo '<span>'; the_title(); echo '</span>';
                                    echo '</li>';
                                }
                            } elseif (is_page()) {
                                echo '<li class="breadcrumb-item" aria-current="page">';
                                 echo the_title();
                                echo '</li>';
                            }
                        }
                        elseif (is_tag()) {single_tag_title();}
                        elseif (is_day()) {echo"<li class='align-items-center breadcrumb-item'>Archive for "; the_time('F jS, Y'); echo'</li>';}
                        elseif (is_month()) {echo"<li class='breadcrumb-item'>Archive for "; the_time('F, Y'); echo'</li>';}
                        elseif (is_year()) {echo"<li class='breadcrumb-item'>Archive for "; the_time('Y'); echo'</li>';}
                        elseif (is_author()) {echo"<li class='breadcrumb-item'>Author Archive"; echo'</li>';}
                        elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li class='breadcrumb-item'>Blog Archives"; echo'</li>';}
                        elseif (is_search()) {echo"<li class='breadcrumb-item'>Search Results"; echo'</li>';}
                        ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <?php
}

function sort_categories($a,$b){
    //return strlen($b->slug)-strlen($a->slug);

    if (strlen($a->slug) == strlen($b->slug)) {
        return 0;
    }
    return (strlen($a->slug) < strlen($b->slug)) ? -1 : 1;
}


function get_categories_menu($cat_outer_class = '', $cat_outer_id = '', $cat_class="col", $cat_link_class = 'justify-content-start', $show_numbers = false){

    global $gm_categories;

    if(!$gm_categories){

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

    }
//var_dump($gm_categories);
    if( $gm_categories ){

        ?><div class="row categories_list_outer <?php echo $cat_outer_class; ?>" <?php if($cat_outer_id){ echo 'id="' . $cat_outer_id . '" '; }?> ><?php

        $count_posts = wp_count_posts();

        $published_posts = $count_posts->publish;

        get_cat_link_template(false, 'Все статьи', $published_posts, $cat_class, $cat_link_class, $show_numbers);

        foreach( $gm_categories as $category ){

                get_cat_link_template($category->term_id, $category->cat_name, $category->category_count, $cat_class, $cat_link_class, $show_numbers);

        } ?>


        </div>

    <?php }

}

function get_cat_link_template($term_id, $cat_name, $category_count, $cat_class="col", $cat_link_class = 'justify-content-start', $show_numbers = false){

    ?>

    <div class="<?php echo $cat_class; ?>">

        <?php
        if(intval($term_id)){
            $link = get_category_link( $term_id );
        }else{
            $link = get_site_url();
        }
        ?>

        <a class="d-flex <?php echo $cat_link_class; ?> cat_link" href="<?php echo $link; ?>">

            <span class="cat_link_text"><?php echo $cat_name; ?></span>

            <?php if($show_numbers){ ?>

                <span class="cat_counter_outer">
                    <span class="badge cat_counter"><?php echo $category_count; ?></span>
                </span>


            <?php } ?>
        </a>
    </div>
<?php

}
