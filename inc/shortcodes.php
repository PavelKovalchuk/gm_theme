<?php



if ( ! function_exists( 'cleaner_caption' ) ) :
    function cleaner_caption( $output, $attr, $content ) {
        preg_match('#<img class="([^"]*)"[^>]*>#i', $content, $matches);

        $thumb_class = '';
        if(count($matches) > 1 AND $matches[1] != '') {
            $classes = explode(' ', $matches[1]);
            $thumb_class = isset($classes[0]) ? $classes[0] : '';
        }

        /* We're not worried abut captions in feeds, so just return the output here. */
        if ( is_feed() )
            return $output;

        /* Set up the default arguments. */
        $defaults = array(
            'id' => '',
            'align' => 'alignnone',
            'width' => '',
            'caption' => '',
        );

        /* Merge the defaults with user input. */
        $attr = shortcode_atts( $defaults, $attr );

        /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
        if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
            return $content;

        /* Set up the attributes for the caption <div>. */
        if($attr['width']!='317'&&$attr['width']!='642'){
            //$custom_attr = 'margin-right:20px;';
        }else{$custom_attr='';}
        $attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
        $attributes .= ' class="d-inline-flex wp-caption ' . esc_attr( $attr['align'] ) . ' ' . esc_attr($thumb_class) . '"';
        $attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px;'.$custom_attr.'"';

        /* Open the caption <div>. */
        $output = '<div' . $attributes .'>';

        /* Allow shortcodes for the content the caption was created for. */
        $output .= '<div class="d-flex img-wrap inner-article-image js-share-parent">' . do_shortcode( $content ) ;

            /* Append the caption text. */
            $output .= '<div class="d-flex align-items-center justify-content-center wp-caption-text"><div class="col text-center  wp-caption-text-inner"><p>' . $attr['caption'] . '</p></div></div>';

        $output .= '</div>'; // end of .img-wrap



        /* Close the caption </div>. */
        $output .= '</div>';
        if($thumb_class === 'size-two-images-2' OR $thumb_class === 'three-images-3') {
            $output .= '<div class="clear"></div>';
        }

        /* Return the formatted, clean caption. */
        return $output;
    }
endif;
add_filter( 'img_caption_shortcode', 'cleaner_caption', 10, 3 );


function my_img_title_filter($attr) {
    $attr['title'] = $attr['alt'];
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'my_img_title_filter' );


function k99_attachment_image_link_void( $content ) {
    $content =
        preg_replace(array('{<a[^>]*><img}','{/></a>}'), array('<img','/>'), $content);
    return $content;
}

add_filter( 'the_content', 'k99_attachment_image_link_void' );



if ( ! function_exists( 'gm_custom_sizes' ) ) :
    function gm_custom_sizes( $sizes ) {
        return array_merge( $sizes, array(
            'two-images-1' => __('Two images collection. Image 1 (Big)'),
            'two-images-2' => __('Two images collection. Image 2 (Small)'),
            'three-images-1' => __('Three images collection. Image 1'),
            'three-images-2' => __('Three images collection. Image 2'),
            'three-images-3' => __('Three images collection. Image 3'),
            'related-post-thumbnail' => __('related-post-thumbnail'),
            'size-645-459' => __('size-645-459'),
            'size-318-459' => __('size-318-459'),
            'big-973-500' => __('big-973-500'),
        ) );
    }
endif;
add_filter( 'image_size_names_choose', 'gm_custom_sizes' );