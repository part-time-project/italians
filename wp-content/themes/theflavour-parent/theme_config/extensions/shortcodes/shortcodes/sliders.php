<?php
function tfuse_sliders($atts){
    global $TFUSE;
    extract(shortcode_atts(array('slider_id' => ''), $atts));
    $output = '';
    
    if($slider_id != '-1')
    {
        $slider = $TFUSE->ext->slider->model->get_slider($slider_id);

        switch ($slider['type']):
           case 'custom':
                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) : 
                        $image = new TF_GET_IMAGE();
                        $slider['slides'][$k]['slide_src'] = $image->width(1920)->height(930)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                    endforeach;
                endif;
                break;
        endswitch;

        if ( !is_array($slider['slides']) ) return;
        $output .= tfuse_render_view(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php'),$slider);
    }

    return $output;
}
global $TFUSE;

$atts = array(
    'name' => __('Sliders', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Select Slider', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_sliders_slider_id',
            'value' => '',
            'options' => $TFUSE->ext->slider->get_sliders_dropdown(),
            'type' => 'select',
        )
    )
);

tf_add_shortcode('sliders', 'tfuse_sliders', $atts);