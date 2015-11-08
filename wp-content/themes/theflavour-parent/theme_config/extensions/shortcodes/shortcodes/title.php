<?php
/**
 * H Titles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * [title]Subtitle of the paragraph <span>(h2)</span>[/title]
 * [title h4=""]H4 header example[/title]
 * [title h3="title_blue"]Blue Title[/title]
 * [title h3="title_black"]Black Title[/title]
 */

function tfuse_shortcode_title($atts, $content = null)
{
    extract(shortcode_atts(array('type' => 'h2',  'class' => ''), $atts));
    $class = (!empty($class)) ? ' class="' . $class . '"' : '';
    return '<' . $type . $class . '>' . do_shortcode($content) . '</' . $type . '>';
}

$atts = array(
    'name' => __('Title','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select the type of the title','tfuse'),
            'id' => 'tf_shc_title_type',
            'value' => 'h2',
            'options' => array(
                'h1' => __('h1','tfuse'),
                'h2' => __('h2','tfuse'),
                'h3' => __('h3','tfuse'),
                'h4' => __('h4','tfuse'),
                'h5' => __('h5','tfuse'),
                'h6' => __('h6','tfuse')
            ),

            'type' => 'select'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode. To specify multiple classes,<br /> separate the class names with a space, e.g. <b>"left important"</b>','tfuse'),
            'id' => 'tf_shc_title_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter title and if want specify the class do this in one of these fiealds (h1...h6)','tfuse'),
            'id' => 'tf_shc_title_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('title', 'tfuse_shortcode_title', $atts);