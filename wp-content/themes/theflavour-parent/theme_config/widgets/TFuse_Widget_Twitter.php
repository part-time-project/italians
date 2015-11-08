<?php
class TFuse_Widget_Twitter extends WP_Widget {

    function TFuse_Widget_Twitter()
    {
        $widget_ops = array('classname' => '', 'description' => __("Display tweets","tfuse"));
        $this->__construct('twitter', __('TFuse - Twitter','tfuse'), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title',  empty($instance['title']) ? __('Twitter','tfuse') : $instance['title'], $instance, $this->id_base);
        $username = apply_filters( 'widget_items', $instance['username'], $instance, $this->id_base);
        $items = apply_filters( 'widget_items', $instance['items'], $instance, $this->id_base);
        $return_html = '';

        if ( !empty($username) )
        {
            $tweets = tfuse_get_tweets($username,$items);

            $before_widget = '<div class="widget widget_twitter">';
            $after_widget ='</div>';

            $return_html .= $before_widget;

            if (!empty($title)) $return_html .= '<h3 class="widget-title">' . tfuse_qtranslate($title) . '</h3>';

            $return_html .= '<div class="tweet_list">';
            foreach ( $tweets as $tweet )
            {
                $return_html .= '<div class="tweet_item clearfix">';
                $return_html .= '<div class="tweet_image"><img src="'.$tweet->user->profile_image_url.'" width="58" height="58" alt="" /></div>';
                if( isset($tweet->text) )
                {
                    $return_html .= '<div class="tweet_text">'.$tweet->text;
                }
                if ( !empty($tweet->created_at) )
                    $return_html .= '<br><span class="tweet_time">'.ucfirst($tweet->created_at).'</span>';
                if( isset($tweet->text) ) $return_html .= '</div>';
                $return_html .= '</div>';
            }
            $return_html .= '</div>'.$after_widget;
        }

        echo $return_html;
    }
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['username'] = $new_instance['username'];
        $instance['items'] = $new_instance['items'];
        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '','username' => '','items' => '') );
        $title = $instance['title'];
        $username = $instance['username'];
        $items = $instance['items'];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items:','tfuse'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" />
        </p>
    <?php
    }
}
register_widget('TFuse_Widget_Twitter');