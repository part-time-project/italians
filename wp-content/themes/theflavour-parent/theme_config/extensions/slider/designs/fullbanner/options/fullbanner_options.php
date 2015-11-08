<?php
/**
 * FullBanner slider's configurations
 *
 * @since  The Flavour 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings','tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings','tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title','tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)','tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('Slides Interval','tfuse'),
                            'desc' => __('Enter the slides interval','tfuse'),
                            'id' => 'slider_interval',
                            'value' => '8000',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array('name' => __('Resize images?','tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?','tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides','tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Title','tfuse'),
                            'desc' => __('The Title is displayed on the image and will be visible by the users. Can use "span" tag','tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text',
                            'required' => TRUE,),
                        array('name' => __('Subtitle','tfuse'),
                            'desc' => __('The Subtitle is displayed on the image and will be visible by the users.You can use span or strong tag','tfuse'),
                            'id' => 'slide_subtitle',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true),
                        // Custom Image
                        array('name' => __('Image (1920 x 930)','tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.','tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE,
                            'divider' => true),
                        array('name' => __('Button Text','tfuse'),
                            'desc' => __('Enter the button text','tfuse'),
                            'id' => 'slide_btn_text',
                            'value' => 'discover our place',
                            'type' => 'text',
                            'divider' => true),
                        array('name' => __('URL','tfuse'),
                            'desc' => __('Enter the URL','tfuse'),
                            'id' => 'slide_url',
                            'value' => '#',
                            'type' => 'text',
                            'divider' => true),
                    )
                )
            )
        ),

    )
);

$options['extra_options'] = array();
?>