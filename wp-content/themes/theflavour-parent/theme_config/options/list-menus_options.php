<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for categories area.             */
/* ----------------------------------------------------------------------------------- */

$directory = get_template_directory_uri();

$options = array(
    // Header Image
    array('name' => __('Header Image','tfuse'),
        'desc' => __('Please upload the image for header.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_image',
        'value' => '',
        'type' => 'upload'
    ),
    // Category Icon
    array('name' => __('Category Icon','tfuse'),
        'desc' => __('Please upload the category icon (100x100).','tfuse'),
        'id' => TF_THEME_PREFIX . '_category_icon',
        'value' => '',
        'type' => 'upload'
    ),
    array('name' => __('Menu Type','tfuse'),
        'desc' => __('Select your preferred menu type','tfuse'),
        'id' => TF_THEME_PREFIX . '_menu_type',
        'value' => '1',
        'options' => array(
            '1' => array($directory . '/images/post-type/menu_type1.png', __('Menu with image', 'tfuse')),
            '2' => array($directory . '/images/post-type/menu_type2.png', __('Menu without image', 'tfuse')),
        ),
        'type' => 'images',
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