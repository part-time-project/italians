<?php
/**
 * Upcoming Events
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_upcoming_events($atts, $content = null)
{
    extract(shortcode_atts(array('items' => 3, 'title' => 'Popular Posts', 'before_title' => '' ), $atts));
    $return_html = '';
    $upcoming_events = tfuse_get_upcoming_events((int)$items);

    $return_html .= '<div class="col-sm-12 upcoming_events_wrap"><div class="container"><div class="row">
    <section class="next-events">
        <div class="row">';
    if($before_title != '') $return_html .= '<h2 class="page-title-before">'.$before_title.'</h2>';
    if($title != '') $return_html .= '<h1 class="page-title">'.$title.'</h1>';

    if(!empty($upcoming_events)){
        foreach($upcoming_events as $single_event){
            $event_id = $single_event['event_id'];
            $event_title = $single_event['event_title'];
            $event_date = $single_event['event_date'];
            $event_date = date("F j, Y", strtotime($event_date));
            $excerpt = $single_event['event_excerpt'];
            $permalink = $single_event['event_permalink'];
            $return_html .= '<div class="col-md-3 col-sm-6">
                        <article class="post">';
            if(has_post_thumbnail($event_id)) {
                $return_html .= '<div class="inner">
                                    <a href="'.$permalink.'" class="post-thumbnail">'.get_the_post_thumbnail($event_id, 'post-thumb2').'</a>
                                </div>';
            }
            $return_html .= '<div class="border-post">
                                <div class="entry-aside">
                                    <header class="entry-header">
                                        <div class="post-date"><span>'.$event_date.'</span></div>
                                        <h1 class="entry-title">
                                            <a href="'.$permalink.'">'.$event_title.'</a>
                                        </h1>
                                    </header>
                                    <div class="entry-content">'.$excerpt.'</div>
                                    <footer class="entry-meta">
                                        <div class="ribbon ribbon-small">
                                            <a href="'.$permalink.'">
                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 261.98 57.981" enable-background="new 0 0 261.98 57.981" xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M36.638,7.173l8.318,50.808h172.071l8.318-50.808H36.638z M45.59,0H0.369l15.234,25.403L0,50.808h39.688
                                                            L32.451,4.784L45.59,0z M246.377,25.403L261.611,0h-45.22l13.137,4.784l-7.235,46.023h39.686L246.377,25.403z"/>
                                                        </g>
                                                    </g>
                                                    <span>'.__('details','tfuse').'</span>
                                                </svg>
                                            </a>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </article>
                    </div>';
        }
    }
    $return_html .= '</div>
    </section></div></div></div><div class="clear"></div>';


    return $return_html;
}

$atts = array(
    'name' => __('Upcoming Events','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for an shortcode','tfuse'),
            'id' => 'tf_shc_upcoming_events_title',
            'value' => 'Upcoming Events',
            'type' => 'text'
        ),
        array(
            'name' => __('Before title','tfuse'),
            'desc' => __('Specifies the before title for an shortcode','tfuse'),
            'id' => 'tf_shc_upcoming_events_before_title',
            'value' => '...or browse the next',
            'type' => 'text'
        ),
        array(
            'name' => __('Items','tfuse'),
            'desc' => __('Specifies the number of the events to show','tfuse'),
            'id' => 'tf_shc_upcoming_events_items',
            'value' => '3',
            'type' => 'text'
        ),
    )
);

tf_add_shortcode('upcoming_events', 'tfuse_upcoming_events', $atts);