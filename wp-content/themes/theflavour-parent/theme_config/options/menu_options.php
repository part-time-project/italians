<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */
$directory = get_template_directory_uri();

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */

    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Options */
    array('name' => __('Post Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_options',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Price
    array('name' => __('Price','tfuse'),
        'desc' => __('Please separate with the "." - dot separator. Ex: 3.95','tfuse'),
        'id' => TF_THEME_PREFIX . '_price',
        'value' => '',
        'type' => 'text'
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