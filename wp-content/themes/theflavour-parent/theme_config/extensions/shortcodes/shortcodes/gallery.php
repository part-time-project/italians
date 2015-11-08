<?php
/**
 * Gallery
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_gallery($atts, $content = null)
{
    extract( shortcode_atts(array('before_title' => '','population' => 'categories', 'categories' => '', 'posts' => '', 'link' => '#', 'link_text' => ''), $atts) );
    $out = '';
    $terms_ids = explode(",", $categories);
    $posts_ids = explode(",", $posts);

    if($population=='categories'){
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 7,
            'tax_query' => array(
                array(
                    'taxonomy' => 'group',
                    'field' => 'id',
                    'terms' => $terms_ids,
                    'operator' => 'IN'
                )
            )
        );
        $posts = get_posts($args);
    }
    else{
        $args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => 7,
            'post__in' => $posts_ids
        );
        $posts = get_posts($args);
        /* for order in initial order */
        $term_arr_ord = array();
        foreach($posts_ids as $key=>$ord){
            foreach($posts as $unord){
                if($ord==$unord->ID) {
                    $term_arr_ord[$key] = $unord;
                    continue;
                }
            }
        }
        $posts = $term_arr_ord;
    }

    if(!empty($posts)){
        $count = 0;
        $out .= '<section class="grid-gallery">';
            foreach($posts as $post){
                ++$count;
                $permalink = get_permalink($post->ID);
                if($count==1){
                    $width = 723;
                    $height = 718;
                    $before = '<div class="grid-galley-col1">';
                    $after = '</div>';
                }
                elseif($count==2){
                    $width = 243;
                    $height = 235;
                    $before = '<div class="grid-galley-col2">';
                    $after = '';
                }
                elseif($count==3){
                    $width = 243;
                    $height = 235;
                    $before = '';
                    $after = '';
                }
                elseif($count==4){
                    $width = 243;
                    $height = 235;
                    $before = '';
                    $after = '</div>';
                }
                elseif($count==5){
                    $width = 358;
                    $height = 355;
                    $before = '<div class="grid-galley-col3">';
                    $after = '';
                }
                elseif($count==6){
                    $width = 358;
                    $height = 355;
                    $before = '';
                    $after = '</div>';
                }
                elseif($count==7){
                    $width = 572;
                    $height = 718;
                    $before = '<div class="grid-galley-col4">';
                    $after = '</div>';
                }
                else{
                    $width = 243;
                    $height = 235;
                    $before = '';
                    $after = '';
                }

                if ( has_post_thumbnail($post->ID) ) {
                    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' );
                    $image = new TF_GET_IMAGE();
                    $img = $image->width($width)->height($height)->src($src[0])->get_src();
                }
                else $img = '';

                $out .= $before.'<div class="box box'.$count.' clearfix" style="background-image:url('.$img.')">
                    <a href="'.$permalink.'" class="box-link-gallery"><strong>'.get_the_title($post->ID).'</strong><br><span>'.__('VIEW MORE DETAILS','tfuse').'</span></a>
                </div>'.$after;
            }

            $out .= '<div class="rhomb">
                <div class="inner">';
                    if($before_title!='') $out .= '<h3 class="rhomb-title-before">'.$before_title.'</h3>';
                    $out .= '<h1 class="rhomb-title">'.$content.'</h1>';
                    if($link!='') $out .= '<a href="'.$link.'" class="see-more">'.$link_text.'</a>';
                $out .= '</div>
            </div>
        </section>';
    }

    return $out;
}

$atts = array(
    'name' => __('Gallery','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_gallery_content',
            'value' => 'Gallery',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Before Title','tfuse'),
            'desc' => __('Enter the before title text','tfuse'),
            'id' => 'tf_shc_gallery_before_title',
            'value' => 'IMAGE',
            'type' => 'text'
        ),
        array(
            'name' => __('Population Method','tfuse'),
            'desc' => __('Please select type of gallery population','tfuse'),
            'id' => 'tf_shc_gallery_population',
            'value' => 'categories',
            'options' => array(
                'categories' => __('From Categories','tfuse'),
                'posts' => __('From Posts','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Enter Categories','tfuse'),
            'desc' => __('Specifies the categories','tfuse'),
            'id' => 'tf_shc_gallery_categories',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'group',
        ),
        array(
            'name' => __('Enter Posts','tfuse'),
            'desc' => __('Specifies the name of post','tfuse'),
            'id' => 'tf_shc_gallery_posts',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'portfolio',
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to. Ex: the events page','tfuse'),
            'id' => 'tf_shc_gallery_link',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Link Text','tfuse'),
            'desc' => __('Enter the text for button link','tfuse'),
            'id' => 'tf_shc_gallery_link_text',
            'value' => 'SEE MORE',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('gallery', 'tfuse_gallery', $atts);