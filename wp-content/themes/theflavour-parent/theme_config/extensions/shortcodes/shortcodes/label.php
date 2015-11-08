<?php
/**
 * Label
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_label($atts, $content = null)
{
    extract( shortcode_atts(array('class' => 'label-default'), $atts) );
    if(empty($class)) $class = 'label-default';
    return '<span class="label '.$class.'">'.do_shortcode($content).'</span>';
}

$atts = array(
    'name' => __('Label','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Enter the label class. Ex: label-primary, label-success, label-info, label-warning, label-danger','tfuse'),
            'id' => 'tf_shc_label_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the content','tfuse'),
            'id' => 'tf_shc_label_content',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('label', 'tfuse_label', $atts);