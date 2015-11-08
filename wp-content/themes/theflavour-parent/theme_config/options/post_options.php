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
    array('name' => __('Post Type','tfuse'),
        'desc' => __('Select your preferred post type','tfuse'),
        'id' => TF_THEME_PREFIX . '_post_type',
        'value' => tfuse_options('single_post_type'),
        'options' => array(
            'post-style-1' => array($directory . '/images/post-type/post-style-1.png', __('Image with left align and rounded', 'tfuse')),
            'post-style-2' => array($directory . '/images/post-type/post-style-2.png', __('Image with right align and rounded', 'tfuse')),
            'post-style-3' => array($directory . '/images/post-type/post-style-3.png', __('Image with left align', 'tfuse')),
            'post-style-4' => array($directory . '/images/post-type/post-style-4.png', __('Image with right align', 'tfuse')),
            'post-style-6' => array($directory . '/images/post-type/post-style-6.png', __('Big image and centered, title after image', 'tfuse')),
            'post-style-7' => array($directory . '/images/post-type/post-style-7.png', __('Big image and centered', 'tfuse')),
        ),
        'type' => 'images',
    ),
    // Mini Description
    array('name' => __('Mini Description','tfuse'),
        'desc' => __('Please enter mini description for post','tfuse'),
        'id' => TF_THEME_PREFIX . '_mini_description',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
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
    /* Recipe Options */
    array('name' => __('Recipe Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_recipe_options',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array('name' => __('Recipe Title','tfuse'),
        'desc' => __('Enter the recipe title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_recipe_title',
        'value' => '',
        'type' => 'text'
    ),
    array('name' => __('Recipe Description','tfuse'),
        'desc' => __('Enter the recipe description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_recipe_description',
        'value' => '',
        'type' => 'textarea',
        'divider' => true
    ),
    array('name' => __('Recipe Ingredients','tfuse'),
        'id' => TF_THEME_PREFIX . '_recipe_ingredients',
        'desc' => __('Enter the recipe ingredients.','tfuse'),
        'btn_labels'=>array('Add ingredient','Delete ingredient'),
        'class' => 'tf-post-table ',
        'style' => '',
        'default_value' => array(
            'tab_title'=>'',
            'tab_content'=>''
        ),
        'value' => array(
            array(
                'tab_title'=>'',
                'tab_content'=>''
            )
        ),
        'type' => 'div_table',
        'columns' => array(
            array(
                'id' =>  'tab_title',
                'type' => 'text',
                'properties' => array('placeholder' => __('Add Item', 'tfuse'))
            )
        ),
        'divider' => true
    ),
    array('name' => __('Recipe Method','tfuse'),
        'desc' => __('Enter the recipe method.','tfuse'),
        'id' => TF_THEME_PREFIX . '_recipe_method',
        'value' => '',
        'type' => 'textarea'
    ),

);

?>