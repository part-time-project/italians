<?php
/**
 * Initializing deafault sidebars
 *
 * @since The Flavour 1.0
 */

function sidebar_attachment ($post_types){
    unset($post_types['attachment']);
    return $post_types;
}
add_filter('tfuse_sidebar_posts', 'sidebar_attachment');

function sidebar_events($taxonomies){
    unset($taxonomies['group']);
    unset($taxonomies['events']);
    unset($taxonomies['list-menus']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_taxonomies', 'sidebar_events');

add_filter('tf_get_taxonomies', 'custom_get_taxonomies_args');
function custom_get_taxonomies_args ($args){
    $args = array(
        'public' => TRUE,
        'show_ui' => TRUE,
        '_builtin' => FALSE
    );
    return $args;
}

function tf_sidebar_cfg() {
    static $sidebar_cfg = array();
    #Sidebar options
    $beforeWidget = '<div id="%1$s" class="box %2$s">';
    $afterWidget = '</div>';
    $beforeTitle = '<h3>';
    $afterTitle = '</h3>';
    #End sidebar options
    if (count($sidebar_cfg) == 0) {
        #Sidebar filters
        $beforeWidget = apply_filters('tfuse_filter_before_widget', $beforeWidget);
        $afterWidget = apply_filters('tfuse_filter_after_widget', $afterWidget);
        $beforeTitle = apply_filters('tfuse_filter_before_title', $beforeTitle);
        $afterTitle = apply_filters('tfuse_filter_after_title', $afterTitle);
        #End sidebar filters
        $sidebar_cfg = compact('beforeWidget', 'afterWidget', 'beforeTitle', 'afterTitle');
    }
    return $sidebar_cfg;
}

function tf_sidebars_init() {
    extract(tf_sidebar_cfg());
    register_sidebar(array('name' => __('General Sidebar','tfuse'), 'id' => 'sidebar-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));
}

tf_sidebars_init();
