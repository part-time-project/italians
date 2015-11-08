<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Media */
    array('name' => __('Event Settings','tfuse'),
        'id' => TF_THEME_PREFIX . '_media',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Select day','tfuse'),
        'desc' => __('Select event date.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_date',
        'value' => '',
        'type' => 'datepicker'
    ),
    array('name' => __('Beginning Hour','tfuse'),
        'desc' => __('Select event beginning hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour'
    ),
	array('name' => __('End Hour','tfuse'),
        'desc' => __('Select event end hour.','tfuse'),
        'id' => TF_THEME_PREFIX . '_end_hour_min',
        'value' => '',
        'type' => 'callback',
        'callback'	=> 'select_hour_end'
    ),
    array('name' => __('Repeat','tfuse'),
        'desc' => __('Select type of event repetition.','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_repeat',
        'value' => 'no',
        'options' => array('no' => __('No Repeat','tfuse'),'day' => __('Every day','tfuse'),'week' => __('Every week','tfuse'),'month' => __('Every month','tfuse'),'year' => __('Every year','tfuse')),
        'type' => 'select',
    ),
    array('name' => __('Special Event ?','tfuse'),
        'desc' => __('Check yes if this events is special. This is used in special events shortcode','tfuse'),
        'id' => TF_THEME_PREFIX . '_event_special',
        'value' => false,
        'type' => 'checkbox'
    ),

    /* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_options',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Before Menu
    array('name' => __('Shortcodes Before Menu','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_before_menu',
        'value' => '',
        'type' => 'textarea'
    ),
    // Top Shortcodes
    array('name' => __('Shortcodes Before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes After Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    ),
);

?>