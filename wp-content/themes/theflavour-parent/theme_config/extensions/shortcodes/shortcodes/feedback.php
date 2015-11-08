<?php
/**
 * Feedback
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_feedback($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '', 'before_title' => '', 'link' => '#'), $atts) );
    $out = '';
    $out .= '<div class="widget-container widget-feedback">';
        if($before_title != '') $out .= '<h3 class="widget-title-before">'.$before_title.'</h3>';
        if($title != '') $out .= '<h1 class="widget-title">'.$title.'</h1>';
        $out .= '<div class="widget-content"><p>'.do_shortcode($content).'</p></div>';
        $out .= '<div class="widget-readmore"><a href="'.$link.'"><span class="tficon-row"></span></a></div>';
    $out .= '</div>';

    return $out;
}

$atts = array(
    'name' => __('Feedback','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title of shortcode','tfuse'),
            'id' => 'tf_shc_feedback_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Before Title','tfuse'),
            'desc' => __('Enter the before title of shortcode','tfuse'),
            'id' => 'tf_shc_feedback_before_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_feedback_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_feedback_link',
            'value' => '#',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('feedback', 'tfuse_feedback', $atts);