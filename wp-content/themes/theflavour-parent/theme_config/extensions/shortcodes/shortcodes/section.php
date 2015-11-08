<?php
/**
 * Section
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_section($atts, $content = null)
{
    extract( shortcode_atts(array('parallax' => 'false', 'image' => '', 'class' => ''), $atts) );
    $out = '';

    if($parallax == 'true'){
        $out .= '<section class="'.$class.' parallax-section" style="background-image:url('.$image.');">';
        $out .= do_shortcode($content);
        $out .= '</section>';
    }
    else{
        $out .='<section class="'.$class.' main-top">';
        if($image!='') $out .= '<div class="image-section" style="background:url('.$image.');">';
        $out .= do_shortcode($content);
        if($image!='') $out .= '</div>';
        $out .= '</section>';
    }

    return $out;
}

$atts = array(
    'name' => __('Section','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Background Image','tfuse'),
            'desc' => __('Specifies the URL of the image','tfuse'),
            'id' => 'tf_shc_section_image',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Parallax ?','tfuse'),
            'desc' => __('Use with parallax','tfuse'),
            'id' => 'tf_shc_section_parallax',
            'value' => false,
            'type' => 'checkbox'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_section_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode, separated by space.<br /><b>predefined classes:</b> main-top, reservation-section, section-button, bottom-widgets container,  postlist-menu','tfuse'),
            'id' => 'tf_shc_section_class',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('section', 'tfuse_section', $atts);