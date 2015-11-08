<?php
/* Recent / Most Commented */

function tfuse_tabs_posts($atts) {
    extract(shortcode_atts(array('items' => ''), $atts));

    $popular_posts = tfuse_shortcode_posts(
        array(
            'sort' => 'popular',
            'items' => $items,
            'image_post' => true,
            'image_width' => 50,
            'image_height' => 50,
            'image_class' => 'thumb',
            'date_format' => 'M j, Y',
            'date_post' => true
        )
    );
    $latest_posts = tfuse_shortcode_posts(
        array(
            'sort' => 'commented',
            'items' => $items,
            'image_post' => true,
            'image_width' => 50,
            'image_height' => 50,
            'image_class' => 'thumb',
            'date_format' => 'M j, Y',
            'date_post' => true,
        )
    );
    $return_html = '';

    $return_html .= '<div class="tabs_framed no-padding">
        <div class="inner">
            <ul class="nav nav-tabs clearfix active_bookmark1">
                <li class="active"><a href="#tab_cont_1_1" data-toggle="tab">'.__('Recent Posts','tfuse').'</a></li>
                <li><a href="#tab_cont_1_2" data-toggle="tab">'.__('Most Commented','tfuse').'</a></li>
            </ul>
            <div class="tab-content clearfix">
                <div id="tab_cont_1_1" class="tab-pane fade in active">
                    <ul class="post_list recent_posts">';
                        foreach ($popular_posts as $post_val) {
                            $return_html .= '<li class="clearfix">';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a>'. ' <a href="' . $post_val['post_link'] . '" >' . $post_val['post_title'] . '</a>';
                            $return_html .= '<div class="date">' . $post_val['post_date_post'] . '</div>';
                            $return_html .= '</li>';
                        }
                    $return_html .= '</ul>
                </div>

                <div id="tab_cont_1_2" class="tab-pane fade">
                    <ul class="post_list popular_posts">';
                        foreach ($latest_posts as $post_val) {
                            $return_html .= '<li class="clearfix">';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" >' . $post_val['post_img'] . '</a>';
                            $return_html .= '<a href="' . $post_val['post_link'] . '" >&nbsp;' . $post_val['post_title'] . '</a>';
                            $return_html .= '<div class="date">' . $post_val['post_date_post'] . '</div>';
                            $return_html .= '</li>';
                        }
                    $return_html .= '</ul>
                </div>
            </div>
        </div>
    </div>';

    return $return_html;
}

$atts = array(
    'name' => __('Tab Posts','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the post to show','tfuse'),
            'id' => 'tf_shc_tabs_posts_items',
            'value' => '5',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('tabs_posts','tfuse_tabs_posts', $atts);