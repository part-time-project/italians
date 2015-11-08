<?php
/**
 * Latest Article
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_latest_article($atts, $content = null)
{
    extract( shortcode_atts(array('title' => ''), $atts) );
    $out = '';
    $args = array(
        'posts_per_page'   => 1
    );
    $posts_array = get_posts( $args );
    if(!empty($posts_array)){
        $out .= '<div class="widget-container widget-lastet-blog-article">';
            if($title != '') $out .= '<h3 class="widget-title-before">'.$title.'</h3>';
            $out .= '<h1 class="widget-title">'.$posts_array[0]->post_title.'</h1>';
            $out .= '<div class="widget-content">'.$posts_array[0]->post_excerpt.'</div>';
            $out .= '<div class="widget-readmore"><a href="'.get_permalink($posts_array[0]->ID).'"><span class="tficon-row"></span></a></div>
        </div>';
    }

    return $out;
}

$atts = array(
    'name' => __('Latest Article','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title of shortcode','tfuse'),
            'id' => 'tf_shc_latest_article_title',
            'value' => 'From the blog',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('latest_article', 'tfuse_latest_article', $atts);