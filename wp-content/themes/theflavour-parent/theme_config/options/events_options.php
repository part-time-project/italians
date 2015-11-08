<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$options = array(
    // Title
    array('name' => __('Title','tfuse'),
        'desc' => __('Select your preferred Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'hide_title',
        'options' => array('hide_title' => __('Hide Page Title','tfuse'), 'default_title' => __('Default Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => __('Custom Title','tfuse'),
        'desc' => __('Enter your custom title for this page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    // Before Title
    array('name' => __('Before Title','tfuse'),
        'desc' => __('Enter your before title for this page.','tfuse'),
        'id' => TF_THEME_PREFIX . '_before_title',
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