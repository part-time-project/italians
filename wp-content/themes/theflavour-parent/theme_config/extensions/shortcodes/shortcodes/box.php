<?php
/**
 * Styled Boxes
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 * Optional arguments:
 * title: Shortcode title
 * class: custom class
 */

function tfuse_styled_box($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','type' => 'sb', 'class' => 'panel-default'), $atts) );

    if ($type == 'alert')
    {
        $html = '<div class="alert '.$class.'">
            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'.do_shortcode($content).'
        </div>';
    }
    else
    {
        $html = '<div class="panel '.$class.'">';
        if($title!='') $html .= '<div class="panel-heading">'.$title.'</div>';
        $html .= '<div class="panel-body">'.do_shortcode($content).'</div></div>';
    }

    return $html;
}
$atts = array(
    'name' => __('Boxes','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the box','tfuse'),
            'id' => 'tf_shc_styled_box_title',
            'value' => __('Styled box Title', 'tfuse'),
            'type' => 'text'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Type of boxes','tfuse'),
            'id' => 'tf_shc_styled_box_type',
            'value' => 'sb',
            'options' => array(
                'sb' => __('Styled Box','tfuse'),
                'alert' => __('Alert Box','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode, separated by space.<br /><b>predefined classes:</b> panel-primary, panel-success, panel-info, panel-warning','tfuse'),
            'id' => 'tf_shc_styled_box_class',
            'value' => 'panel-default',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_styled_box_content',
            'value' => 'Insert the content here',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('styled_box', 'tfuse_styled_box', $atts);