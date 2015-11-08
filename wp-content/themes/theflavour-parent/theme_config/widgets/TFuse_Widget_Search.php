<?php
// =============================== Search widget ======================================

class TF_Widget_Search extends WP_Widget {

	function TF_Widget_Search() {
        $widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site","tfuse") );
        $this->__construct('search', __('TFuse - Search','tfuse'), $widget_ops);
	}

	function widget($args, $instance) { 
        extract($args);
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

        $before_widget = '<div class="widget widget-search">';
        $after_widget ='</div>';

        echo $before_widget; ?>

        <?php if(!empty($title)){ ?>
            <h3 class="widget-title"><?php echo tfuse_qtranslate($title); ?></h3>
        <?php } ?>
        <form method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
            <input name="s" id="s" type="text" class="inputtext" placeholder="<?php echo tfuse_options('search_box_text'); ?>" name="search" value="">
            <button type="submit" class="btn btn-search"><span class="tficon-row"></span></button>
        </form>

    <?php echo $after_widget;
    }

	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
        $instance['title'] = $new_instance['title'];
        return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = $instance['title'];
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
    <?php
    }
}

function TFuse_Unregister_WP_Widget_Search() {
	unregister_widget('WP_Widget_Search');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Search');

register_widget('TF_Widget_Search');