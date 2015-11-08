<?php
class TF_Widget_Text extends WP_Widget {

    function TF_Widget_Text() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML','tfuse'));
        $control_ops = array('width' => 400, 'height' => 350);
        $this->__construct('text', __('TFuse - Text','tfuse'), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $enable_social = esc_attr($instance['enable_social']);
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        $tf_class = ( @$instance['nopadding'] ) ? 'class="widget widget-text nopadding"' : 'class="widget widget-text "';

        $before_widget = '<div id="text-'.$args['widget_id'].'" '.$tf_class.'>';
        $after_widget = '</div>';
        $before_title = '<h3 class="widget-title">';
        $after_title = '</h3>';

        echo $before_widget;
        $title = tfuse_qtranslate($title);
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
        <div class="aboutw">
            <?php echo $instance['filter'] ? wpautop($text) : $text; ?>
            <?php if($enable_social) { ?>
                <div class="social-links">
                    <?php tfuse_footer_social(); ?>
                </div>
            <?php } ?>
        </div>
    <?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['class'] = $new_instance['class'];
        if ( current_user_can('unfiltered_html') )
            $instance['text'] =  $new_instance['text'];
        else
            $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
        $instance['filter'] = isset($new_instance['filter']);
        $instance['nopadding'] = isset($new_instance['nopadding']);
        $instance['enable_social'] = isset($new_instance['enable_social']);
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'enable_social' => '', 'text' => '', 'nopadding' => '' ) );
        $title = $instance['title'];
        $text = format_to_edit($instance['text']); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

        <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','tfuse'); ?></label></p>
        <p><input id="<?php echo $this->get_field_id('nopadding'); ?>" name="<?php echo $this->get_field_name('nopadding'); ?>" type="checkbox" <?php checked(isset($instance['nopadding']) ? $instance['nopadding'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('nopadding'); ?>"><?php _e('No Margin and padding','tfuse'); ?></label></p>
        <p><input id="<?php echo $this->get_field_id('enable_social'); ?>" name="<?php echo $this->get_field_name('enable_social'); ?>" type="checkbox" <?php checked(isset($instance['enable_social']) ? $instance['enable_social'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('enable_social'); ?>"><?php _e('Enable social buttons?','tfuse'); ?></label></p>
    <?php
    }
}

function TFuse_Unregister_WP_Widget_Text() {
    unregister_widget('WP_Widget_Text');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Text');

register_widget('TF_Widget_Text');