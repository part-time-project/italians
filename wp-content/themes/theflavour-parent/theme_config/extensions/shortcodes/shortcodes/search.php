<?php
/**
 * Search form
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_search($atts)
{
    extract(shortcode_atts(array('title'=>''), $atts));

    if( empty($title) ) $title =  __('SEARCH WIDGET' ,'tfuse');
    $output = '';
    $output .= '<div class="widget widget-search">
        <h3 class="widget-title">' . tfuse_qtranslate($title) . '</h3>
        <form method="get" id="searchform" action="' . home_url('/') . '">
            <input name="s" id="s" type="text" class="inputtext" placeholder="' . tfuse_options('search_box_text') . '" name="search" value="">
            <button id="searchsubmit" type="submit" class="btn btn-search"><span class="tficon-row"></span></button>
        </form>
    </div>';
    return $output;
}

$atts = array(
    'name' => __('Search','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_search_title',
            'value' => 'Search blog',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('search', 'tfuse_search', $atts);