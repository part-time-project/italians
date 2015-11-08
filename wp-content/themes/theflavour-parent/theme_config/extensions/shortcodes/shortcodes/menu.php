<?php
/**
 * Menu Type
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_menu_type($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','image' => '','link' => '#', 'link_text' => ''), $atts) );
    $out = '';
    $out .= '<div class="col-sm-4 post menu_type">
        <div class="inner">';
            if($title!='') $out .= '<header class="entry-header">
                <h1 class="entry-title"><a href="'.$link.'">'.$title.'</a></h1>
            </header>';
            if($image!='') {
                $getimage = new TF_GET_IMAGE();
                $img = $getimage->width(295)->height(295)->src($image)->get_img();
                $out .= '<div class="post-thumbnail">
                    <a href="'.$link.'" class="post-find-more">
                    <span><div class="divider up"></div>'.__('Find Out More','tfuse').'<div class="divider down"></div></span>
                    </a>'.$img.'
                </div>';
            }
            $out .= '<div class="entry-content"><p>'.do_shortcode($content).'</p></div>';
            if($link_text!='') $out .= '<footer class="entry-meta">
                <a href="'.$link.'" class="link-view-menu">'.$link_text.'</a>
            </footer>';
        $out .= '</div>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Menu Type','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_menu_type_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Enter the image source','tfuse'),
            'id' => 'tf_shc_menu_type_image',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_menu_type_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_menu_type_link',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Link Text','tfuse'),
            'desc' => __('Specifies the link text','tfuse'),
            'id' => 'tf_shc_menu_type_link_text',
            'value' => 'View Menu',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('menu_type', 'tfuse_menu_type', $atts);