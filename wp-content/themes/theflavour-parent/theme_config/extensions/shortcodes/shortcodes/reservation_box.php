<?php
/**
 * Reservation Box
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_reservation_box($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','before_text' => '','phone' => '', 'link' => '#', 'link_text' => ''), $atts) );
    $out = '';
    $out .= '<div class="col-md-4 reservation">
        <div class="wrap-reservation">
            <img src="'.get_template_directory_uri().'/images/reservation_logo.png">';
            if($title!='') $out .= '<h1 class="title-before">'.$title.'</h1>';
            if($before_text!='') $out .= '<p class="text-before">'.$before_text.'</p>';
            if($phone!='') $out .= '<strong>'.$phone.'</strong>';
            $out .= '<p class="text-after">'.do_shortcode($content).'</p>';
            if($link!='') $out .= '<div class="ribbon ribbon-small">
                <a href="'.$link.'">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 261.98 57.981" enable-background="new 0 0 261.98 57.981" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M36.638,7.173l8.318,50.808h172.071l8.318-50.808H36.638z M45.59,0H0.369l15.234,25.403L0,50.808h39.688
                                L32.451,4.784L45.59,0z M246.377,25.403L261.611,0h-45.22l13.137,4.784l-7.235,46.023h39.686L246.377,25.403z"/>
                            </g>
                        </g>
                        <span>'.$link_text.'</span>
                    </svg>
                </a>
            </div>';
        $out .= '</div>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Reservation Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_reservation_box_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Before Text','tfuse'),
            'desc' => __('Enter the before text','tfuse'),
            'id' => 'tf_shc_reservation_box_before_text',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Phone Number','tfuse'),
            'desc' => __('Specifies the phone number','tfuse'),
            'id' => 'tf_shc_reservation_box_phone',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter content for right part. Can be placed one third column (1/3)','tfuse'),
            'id' => 'tf_shc_reservation_box_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to. Ex: the events page','tfuse'),
            'id' => 'tf_shc_reservation_box_link',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Link Text','tfuse'),
            'desc' => __('Enter the text for button link','tfuse'),
            'id' => 'tf_shc_reservation_box_link_text',
            'value' => 'fill in form',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('reservation_box', 'tfuse_reservation_box', $atts);