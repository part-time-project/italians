<?php
/**
 * Accordion toggle
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_accordion($atts, $content = null) {
    global $c;
    $c = rand(1,100);
    $out = '';
    extract(shortcode_atts(array(), $atts));
    $get_accordion = do_shortcode($content);
    $out .= '<div class="panel-group" id="accordion'.$c.'">'.$get_accordion.'</div>';
    return $out;
}

$atts = array(
    'name' => __('Accordion toggle','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_title',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_class',
            'value' => 'panel-default',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('accordion', 'tfuse_accordion', $atts);

function tfuse_ac_tab($atts, $content = null) {
    global $c;
    extract(shortcode_atts(array('title' => '', 'class' => 'panel-teal'), $atts));
    $uniq_ac = rand(101,200);
    if($class=='') $class = 'panel-default';
    return '<div class="panel '.$class.'">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$c.'" href="#collapse'.$uniq_ac.'">'.$title.'</a>
            </h4>
        </div>
        <div id="collapse'.$uniq_ac.'" class="panel-collapse collapse">
            <div class="panel-body">'.do_shortcode($content).'</div>
        </div>
    </div>';
}

$atts = array(
    'name' => __('Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_ac_tab_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_ac_tab_class',
            'value' => 'panel-default',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_ac_tab_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

add_shortcode('ac_tab', 'tfuse_ac_tab', $atts);