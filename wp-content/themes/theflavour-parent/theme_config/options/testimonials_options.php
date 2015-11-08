<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */
$directory = get_template_directory_uri();

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */

    /* Post Options */
    array('name' => __('Post Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_options',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Testimonials from
    array('name' => __('Testimonials from','tfuse'),
        'desc' => __('Enter the name of site','tfuse'),
        'id' => TF_THEME_PREFIX . '_testimonials_from',
        'value' => '',
        'type' => 'text'
    ),
    // Testimonials URL
    array('name' => __('URL site','tfuse'),
        'desc' => __('Enter the URL of site','tfuse'),
        'id' => TF_THEME_PREFIX . '_testimonials_url',
        'value' => '',
        'type' => 'text'
    ),

);

?>