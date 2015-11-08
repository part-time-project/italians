<?php
/**
 * Rows
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_row($atts, $content = null)
{
    extract(shortcode_atts(array('class' => ''), $atts));
    if($class) $class = ' ' . $class;else $class = '';

    return '<div class="row clearfix ' . $class . '">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Row','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode, separated by space.','tfuse'),
            'id' => 'tf_shc_row_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('The page templates need to be constructed on rows. <br /> You need to use the [row] shortcode when you want your content to go on another row.','tfuse'),
            'id' => 'tf_shc_row_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('row', 'tfuse_row', $atts);