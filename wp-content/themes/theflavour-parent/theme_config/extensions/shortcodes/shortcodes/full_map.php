<?php
/**
 * Full Map
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_full_map($atts, $content = null)
{
    extract(shortcode_atts(array('position' => '', 'title' => '', 'zoom' => '15', 'text' => '', 'wrap_title' => '', 'wrap_beforetitle' => '', 'wrap_address' => '', 'wrap' => 'false' ), $atts));
    $out = '';
    $uniq_id = rand(1,200);
    wp_register_script('google_maps', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', false);
    wp_enqueue_script('google_maps');
    wp_register_script('gmap', tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '3.3.2', false );
    wp_enqueue_script('gmap');

    $coords = explode(':', $position);
    if(sizeof($coords)<2) return '';
    $lat = $coords[0];
    $long = $coords[1];
    if($wrap == 'true'){
        $class = '';
        $out_wrap = '<div class="wrapp-see-location">
            <div class="container">
                <div class="col-sm-8 col-sm-offset-2">
                    <h3 class="title-before">'.$wrap_beforetitle.'</h3>
                    <h1 class="title">'.$wrap_title.'</h1>
                    <h2 class="title-after">'.$wrap_address.'</h2>
                    <a href="#" class="btn btn-black btn-see-location" id="btn-see-location"><span>'.__('SEE location on map','tfuse').'</span></a>
                </div>
            </div>
        </div>
        <script>
            jQuery(".btn-see-location").click(function (e) {
                e.preventDefault();
                jQuery(this).parents(".wrapp-see-location").fadeOut("slow");
            });
        </script>';
    }
    else{
        $class = 'contact-page';
        $out_wrap = '';
    }
    $out .= '<section class="main-top">
        <div class="see-location '.$class.'">
            <div class="row">
                <div id="contact_map'.$uniq_id.'" class="map contact_map"></div>
                <script>
                    jQuery(window).ready(function () {
                        jQuery("#contact_map'.$uniq_id.'").gMap({
                            markers: [{
                                latitude: '.$lat.',
                                longitude: '.$long.',
                                title: "'.$title.'",
                                html: "'.$text.'",
                                popup: false,
                                icon: {
                                    image: "'.get_template_directory_uri().'/images/icons/gmap_icon.png'.'",
                                    iconsize: [25, 34],
                                    iconanchor: [12,34],
                                    infowindowanchor: [0, 0]
                                }
                            }],
                            zoom: '.$zoom.',
                            scrollwheel: false,
                            maptype: google.maps.MapTypeId.ROADMAP
                        });
                    });
                </script>
            </div>';
        $out .= $out_wrap;
        $out .= '</div>
     </section>';
    return $out;
}

$atts = array(
    'name' => __('Full Map','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 10,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of the map','tfuse'),
            'id' => 'tf_shc_full_map_title',
            'value' => 'Company Name LTD',
            'type' => 'text'
        ),
        array(
            'name' => __('Map position','tfuse'),
            'desc' => __('Choose your map location','tfuse'),
            'id' => 'tf_shc_full_map_position',
            'value' => '',
            'type' => 'maps'
        ),
        array(
            'name' => __('Text','tfuse'),
            'desc' => __('Specifies the text of the map','tfuse'),
            'id' => 'tf_shc_full_map_text',
            'value' => '<strong>Company Name HQ</strong> <br> 880 Sunset Boulevard, San Diego, CA, United States <br>Tel.: 555-522.326',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Zoom','tfuse'),
            'desc' => __('Specifies the zooming of the map','tfuse'),
            'id' => 'tf_shc_full_map_zoom',
            'value' => '15',
            'type' => 'text'
        ),
        array(
            'name' => __('Show wrap?','tfuse'),
            'desc' => __('Show wrap','tfuse'),
            'id' => 'tf_shc_full_map_wrap',
            'value' => false,
            'type' => 'checkbox'
        ),
        array(
            'name' => __('Wrap title','tfuse'),
            'desc' => __('Specifies the wrap title','tfuse'),
            'id' => 'tf_shc_full_map_wrap_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Wrap before title','tfuse'),
            'desc' => __('Specifies the wrap before title','tfuse'),
            'id' => 'tf_shc_full_map_wrap_beforetitle',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Wrap address','tfuse'),
            'desc' => __('Specifies the wrap address','tfuse'),
            'id' => 'tf_shc_full_map_wrap_address',
            'value' => '',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('full_map', 'tfuse_full_map', $atts);