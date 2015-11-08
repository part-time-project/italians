<?php
/**
 * List
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_list($atts, $content = null)
{
    extract( shortcode_atts(array('class' => '', 'type' => ''), $atts) );
    $div_class = (!$class)? '' : ' ' . $class;
    return '<div class="' .$type .' '. $div_class . '">'. do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create check lists','tfuse'),
            'id' => 'tf_shc_list_content',
            'value' => '
<ul>
    <li>List item 1</li>
    <li>List item 2</li>
    <li>List item 3</li>
</ul>
            ',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Select list type','tfuse'),
            'desc' => __('Select the list type','tfuse'),
            'id' => 'tf_shc_list_type',
            'value' => 'list-check',
            'options' => array(
                'list-caret-right' => __('Arrow','tfuse'),
                'list-check' => __('Checklist','tfuse'),
                'list-remove' => __('Remove','tfuse'),
                'list-external-link' => __('Links','tfuse'),
                'list-chevron-sign-right' => __('Chevron','tfuse'),
                'list-thumbs-up' => __('Thumbs up','tfuse'),
                'list-music' => __('Music','tfuse'),
                'list-question-sign' => __('Questions','tfuse'),
                'list-download' => __('Download','tfuse'),
                'list-file-text-alt' => __('Text Files','tfuse'),
                'list-hand-right' => __('Hand Right','tfuse'),
                'list-ok' => __('OK list','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode, separated by space.','tfuse'),
            'id' => 'tf_shc_list_class',
            'value' => '',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('list', 'tfuse_list', $atts);