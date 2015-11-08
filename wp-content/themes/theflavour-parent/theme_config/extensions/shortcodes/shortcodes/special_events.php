<?php
/**
 * Special Events
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_special_events($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','before_title' => '','number' => 3, 'link' => '#', 'link_text' => ''), $atts) );
    $out = '';
    $args = array(
        'post_type' => 'event',
        'meta_key' => 'special_event',
        'order' => 'Desc',
        'posts_per_page' => $number,
        'meta_query' => array(
            array(
                'key' => 'special_event',
                'value' => 'true',
                'compare' => '=',
            )
        )
    );
    $posts = get_posts($args);
    $out .= '<section class="special-offer">
        <div class="row">
            <div class="special-offer-title">';
                if($before_title!='') $out .= '<h3 class="section-title-before">'.$before_title.'</h3>';
                if($title!='') $out .= '<h1 class="section-title">'.$title.'</h1>';
            $out .= '</div>
            <div class="divider"></div>
            <div class="container">
                <div class="row">
                <div class="col-md-8 postlist">';
                    foreach($posts as $post){
                    $permalink = get_permalink($post->ID);
                    $out .= '<div class="post clearfix">
                        <div class="inner">';
                            if ( has_post_thumbnail($post->ID) ) {
                                $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' );
                                $image = new TF_GET_IMAGE();
                                $img = $image->width(200)->height(200)->src($src[0])->get_src();
                                $out .= '<div class="post-thumbnail"><a href="'.$permalink.'" class="post-find-more"><span><div class="divider up"></div>'.__('Find Out More','tfuse').'<div class="divider down"></div></span></a><img src="'.$img.'"></div>';
                            }
                            $out .= '<div class="entry-aside">
                                <header class="entry-header">
                                    <h1 class="entry-title"><a href="'.$permalink.'">'.get_the_title($post->ID).'</a></h1>
                                </header>
                                <div class="entry-meta">
                                    <a href="'.$permalink.'"><span class="tficon-row"></span></a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="entry-content">'.tfuse_get_post_excerpt($post->ID).'</div>
                            </div>
                        </div>
                    </div>';
                    }
                $out .= '</div>';
                $out .= do_shortcode($content);
                $out .= '</div>
            </div>';
            $out .= '<div class="divider"></div>';
            if($link!=''){
                $out .= '<div class="container">
                    <div class="row">
                        <div class="col-sm-8 clearfix">
                            <a href="'.$link.'" class="btn btn-black-transparent"><span>'.$link_text.'</span></a>
                        </div>
                    </div>
                </div>';
            }
        $out .= '</div>
    </section>';

    return $out;
}

$atts = array(
    'name' => __('Special Events','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_special_events_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Before Title','tfuse'),
            'desc' => __('Enter the before title text','tfuse'),
            'id' => 'tf_shc_special_events_before_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Events Number','tfuse'),
            'desc' => __('Specifies the number of events','tfuse'),
            'id' => 'tf_shc_special_events_number',
            'value' => '3',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter content for right part. Can be placed one third column (1/3)','tfuse'),
            'id' => 'tf_shc_special_events_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to. Ex: the events page','tfuse'),
            'id' => 'tf_shc_special_events_link',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Link Text','tfuse'),
            'desc' => __('Enter the text for button link','tfuse'),
            'id' => 'tf_shc_special_events_link_text',
            'value' => 'find out more',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('special_events', 'tfuse_special_events', $atts);