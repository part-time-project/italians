<?php
/**
 * Tooltip
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_tooltip($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '', 'url' => '#', 'position' => 'top'), $atts) );

    return '<a href="'.$url.'" data-toggle="tooltip" data-placement="'.$position.'" title="'.$title.'">'.do_shortcode($content).'</a>';
}

$atts = array(
    'name' => __('Tooltip','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_tooltip_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('URL','tfuse'),
            'desc' => __('Enter the URL','tfuse'),
            'id' => 'tf_shc_tooltip_url',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the content','tfuse'),
            'id' => 'tf_shc_tooltip_content',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Position','tfuse'),
            'desc' => __('Select tooltip position','tfuse'),
            'id' => 'tf_shc_tooltip_position',
            'value' => 'top',
            'options' => array(
                'top' => __('Top','tfuse'),
                'bottom' => __('Bottom','tfuse'),
                'left' => __('Left','tfuse'),
                'right' => __('Right','tfuse'),
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('tooltip', 'tfuse_tooltip', $atts);