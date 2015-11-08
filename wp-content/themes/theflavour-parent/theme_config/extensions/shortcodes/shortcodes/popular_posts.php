<?php
/**
 * Popular Posts
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * items:
 * title:
 * image_width:
 * image_height:
 * image_class:
 */

function tfuse_popular_posts($atts, $content = null)
{
    remove_filter('excerpt_length', 'tfuse_custom_excerpt_length');
    add_filter( 'excerpt_length', 'tfuse_custom_excerpt_length_short', 99 );
    extract(shortcode_atts(
        array(
            'items' => 5,
            'title' => 'Popular Posts',
            'image_width' => 70,
            'image_height' => 70,
            'image_class' => 'thumb'
        ), $atts)
    );
    $return_html = '';
    $latest_posts = tfuse_shortcode_posts(
        array(
            'sort' => 'popular',
            'items' => $items,
            'image_post' => true,
            'image_width' => $image_width,
            'image_height' => $image_height,
            'image_class' => $image_class,
            'date_post' => true,
        )
    );
    $return_html .= '<div class="widget-container widget_postlist widget_recent_posts">';
    if(!empty($title)) $return_html .= '<h3 class="widget-title">'.tfuse_qtranslate($title).'</h3>';
    $return_html .= '<ul>';
    foreach ($latest_posts as $post_val):
        $return_html .= '<li class="clearfix">
            <a href="'.$post_val['post_link'].'" class="post-title">'.$post_val['post_title'].'</a>
            <div class="post-meta">
                <span class="post-date">'.$post_val['post_date_post'].'</span> &nbsp;|&nbsp;  '.$post_val['post_comnt_numb_link'].'
            </div>
            <div class="extras"><a href="'.$post_val['post_link'].'">'.$post_val['post_img'].'</a> '.$post_val['post_excerpt'].'</div>
            <a href="'.$post_val['post_link'].'" class="link-more">'.__('Read more','tfuse').'</a>
        </li>';
    endforeach;
    $return_html .= '</ul>
    </div>';

    return $return_html;
}

$atts = array(
    'name' => __('Popular Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_popular_posts_items',
            'value' => '2',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_popular_posts_title',
            'value' => 'Popular Posts',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Width','tfuse'),
            'desc' => __('Specifies the width of an thumbnail','tfuse'),
            'id' => 'tf_shc_popular_posts_image_width',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Height','tfuse'),
            'desc' => __('Specifies the height of an thumbnail','tfuse'),
            'id' => 'tf_shc_popular_posts_image_height',
            'value' => '70',
            'type' => 'text'
        ),
        array(
            'name' => __('Image Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>.','tfuse'),
            'id' => 'tf_shc_popular_posts_image_class',
            'value' => 'thumb',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('popular_posts', 'tfuse_popular_posts', $atts);
