<?php
// =============================== Recent Posts Widget ======================================

class TFuse_Recent_Posts extends WP_Widget {

    function TFuse_Recent_Posts() {
        $widget_ops = array('description' => '' );
        parent::__construct(false, __('TFuse - Recent Posts', 'tfuse'),$widget_ops);
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $number = esc_attr($instance['number']);
        if ($number>0) {} else $number = 6;

        $before_widget = '<div class="widget widget-freshpost">';
        $after_widget = '</div>';

        echo $before_widget; ?>

        <?php if(!empty($title)){ ?>
            <h3 class="widget-title"><?php echo tfuse_qtranslate($title); ?></h3>
        <?php } ?>

        <ul class="side-postlist">
            <?php
            $recent_posts = tfuse_shortcode_posts(array(
                'sort' => 'recent',
                'items' => $number,
                'image_post' => false,
                'date_post' => false
            ));

            foreach($recent_posts as $post_val): ?>
                <li><a href="<?php echo $post_val['post_link']; ?>"><span><?php echo $post_val['post_title']; ?></span></a></li>
            <?php endforeach; ?>
        </ul>
        <?php if (isset($instance['enable_rss']) && $instance['enable_rss']){ ?>
            <a href="<?php echo tfuse_options('feedburner_url','#'); ?>" class="btn btn-orange btn-freshpost"><span><?php _e('subscribe to rss feed','tfuse'); ?></span></a>
        <?php } ?>

    <?php echo $after_widget;
    }

   function update($new_instance, $old_instance) {
       $instance['enable_rss'] = isset($new_instance['enable_rss']);
       return $new_instance;
   }

    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array(  'title' => '', 'number' => '') );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = esc_attr($instance['number']);
        if(isset($instance['enable_rss']) && $instance['enable_rss']=='on' ) $instance['enable_rss'] = 1;
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts','tfuse'); ?>:</label>
            <input type="text" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>" class="widefat" id="<?php echo $this->get_field_id('number'); ?>" />
        </p>
        <p><input id="<?php echo $this->get_field_id('enable_rss'); ?>" name="<?php echo $this->get_field_name('enable_rss'); ?>" type="checkbox" <?php checked(isset($instance['enable_rss']) ? $instance['enable_rss'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('enable_rss'); ?>"><?php _e('Enable RSS','tfuse'); ?></label></p>
    <?php
    }
}

function TFuse_Unregister_WP_Widget_Recent_Posts() {
    unregister_widget('WP_Widget_Recent_Posts');
}
add_action('widgets_init','TFuse_Unregister_WP_Widget_Recent_Posts');

register_widget('TFuse_Recent_Posts');