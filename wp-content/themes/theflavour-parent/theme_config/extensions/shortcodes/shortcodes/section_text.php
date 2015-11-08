<?php
/**
 * Section Text
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_section_text($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '', 'before_title' => '', 'type' => 'simple'), $atts) );
    $out = '';

    $out .= '<div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">';
                if($before_title!='') $out .= '<h3 class="title-before">'.$before_title.'</h3>';
                if($title!='') $out .= '<h1 class="title">'.$title.'</h1>';
                $out .= '<div class="text">';
                if($type=='border') {
                    $out .= '<div class="about-year">'.do_shortcode($content).'</div>';
                }
                else{
                    $out .= do_shortcode($content);
                }
                $out .= '</div>';
            $out .= '</div>
        </div>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Section Text','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title','tfuse'),
            'id' => 'tf_shc_section_text_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Bebore Title','tfuse'),
            'desc' => __('Specifies the before title text','tfuse'),
            'id' => 'tf_shc_section_text_before_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_section_text_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select type of text','tfuse'),
            'id' => 'tf_shc_section_text_type',
            'value' => 'simple',
            'options' => array(
                'simple' => __('Simple text','tfuse'),
                'border' => __('Text with border top and bottom','tfuse'),
            ),
            'type' => 'select'
        ),
    )
);

tf_add_shortcode('section_text', 'tfuse_section_text', $atts);