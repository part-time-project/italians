<?php
/**
 * About Boxes
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_about_boxes($atts, $content = null)
{
    extract( shortcode_atts(array('type' => 'title', 'title' => '', 'subtitle' => '', 'image' => '', 'text_align' => 'pull-right'), $atts) );
    $html = '';
    if($text_align == 'pull-right'){
        $text_class = 'pull-right';
        $box_class = 'pull-left';
    }
    else{
        $text_class ='pull-left';
        $box_class = 'pull-right';
    }

    if($type == 'image'){
        $right_style = 'style="width: 39%;"';
        $left_style = 'style="width: 53.7%;"';
    }
    else{
        $right_style = $left_style = '';
    }

    $html .= '<section class="about-us clearfix">';
        $html .= '<div '.$left_style.' class="entry-header '.$box_class.'">';
            if($type=='image'){
                if($image != '')$html .= '<div class="about-thumbnail"><img src="'.$image.'"></div>';
            }
            else{
                if($subtitle != '')$html .= '<div class="about-meta"><h3>'.$subtitle.'</h3></div>';
                if($title != '')$html .= '<div class="about-title">'.$title.'</div>';
            }
        $html .= '</div>';
        $html .= ' <div '.$right_style.' class="entry-content '.$text_class.'">'.do_shortcode($content).'</div>';
    $html .= '</section>';

    return $html;
}
$atts = array(
    'name' => __('About Boxes','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Type of boxes','tfuse'),
            'id' => 'tf_shc_about_boxes_type',
            'value' => 'title',
            'options' => array(
                'title' => __('Title & Subtitle','tfuse'),
                'image' => __('Image','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the box','tfuse'),
            'id' => 'tf_shc_about_boxes_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Subtitle','tfuse'),
            'desc' => __('Enter the subtitle','tfuse'),
            'id' => 'tf_shc_about_boxes_subtitle',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Enter the image URL','tfuse'),
            'id' => 'tf_shc_about_boxes_image',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_about_boxes_content',
            'value' => 'Insert the content here',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Text align','tfuse'),
            'desc' => __('Text align','tfuse'),
            'id' => 'tf_shc_about_boxes_text_align',
            'value' => 'pull-right',
            'options' => array(
                'pull-left' => __('Left','tfuse'),
                'pull-right' => __('Right','tfuse'),
            ),
            'type' => 'select'
        ),
    )
);

tf_add_shortcode('about_boxes', 'tfuse_about_boxes', $atts);