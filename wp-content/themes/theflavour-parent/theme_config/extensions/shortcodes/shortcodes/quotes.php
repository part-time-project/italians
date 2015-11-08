<?php
/**
 * Quotes
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_quote_right($atts, $content = null) {
    return '<p><span class="quote_right">' . do_shortcode($content) . '</span></p>';
}

$atts = array(
    'name' => __('Quote Right','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_right_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_right', 'tfuse_quote_right', $atts);

function tfuse_quote_left($atts, $content = null) {
    return '<div class="quote_left"><div class="inner"><p>' . do_shortcode($content) . '</p></div></div>';
}

$atts = array(
    'name' => __('Quote Left','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_left_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_left', 'tfuse_quote_left', $atts);

function tfuse_blockquote($atts, $content = null)
{
    extract(shortcode_atts(array('class' => '', 'author' => '', 'type' => 'simple'), $atts));
    if($class!='') $class = 'class="'.$class.'"';
    if( $type== 'frame'){
        return '<div class="frame_quote"><blockquote '.$class.'>'.do_shortcode($content).'</blockquote></div>';
    }
    else{
        $out = '<blockquote '.$class.'><div class="inner"><p>'.do_shortcode($content).'</p>';
        if($author != '') $out .= '<small>'.$author.'</small>';
        $out .= '</div></blockquote>';
        return $out;
    }
}

$atts = array(
    'name' => __('BlockQuote','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_blockquote_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Enter Class. Ex: pull-left, pull-right','tfuse'),
            'id' => 'tf_shc_blockquote_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Author','tfuse'),
            'desc' => __('Enter author','tfuse'),
            'id' => 'tf_shc_blockquote_author',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select Type','tfuse'),
            'id' => 'tf_shc_blockquote_type',
            'value' => 'simple',
            'options' => array(
                'simple' => __('Simple Bloquote','tfuse'),
                'frame' => __('Framed Bloquote','tfuse'),
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('blockquote', 'tfuse_blockquote', $atts);