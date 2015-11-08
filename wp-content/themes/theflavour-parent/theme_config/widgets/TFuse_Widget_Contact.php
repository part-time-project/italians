<?php
class TFuse_Widget_Contact extends WP_Widget
{
    function TFuse_Widget_Contact()
    {
        $widget_ops = array('classname' => 'widget_contact', 'description' => __( 'Add Contact in Sidebar','tfuse') );
        $this->__construct('contact', __('TFuse - Contact','tfuse'), $widget_ops);
    }

    function widget( $args, $instance )
    {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $enable_social = esc_attr($instance['enable_social']);
        $before_widget = '<div class="widget widget-text"><div class="textwidget">';
        $after_widget = '</div></div>';
        $tfuse_title = (!empty($title)) ? '<h3 class="widget-title">' .tfuse_qtranslate($title) .'</h3>' : '';

        echo $before_widget;
        echo $tfuse_title;

        if ( $instance['adress'] != '')
            echo '<div class="address">
                <h3 class="title">'.__('ADDRESS:','tfuse').'</h3>
                <p>'.tfuse_qtranslate($instance['adress']).'</p>
            </div>';

        if ( $instance['hours'] != '')
            echo '<div class="openning-hours">
                <h3 class="title">'.__('OPENING HOURS','tfuse').'</h3>
                <p>'.tfuse_qtranslate($instance['hours']).'</p>
            </div>';


        if ( $instance['phone'] != '')
            echo '<div class="phone-number">
                <h3 class="title">'.__('phone number','tfuse').'</h3>
                <p>'.$instance['phone'].'</p>
            </div>';

        if($enable_social) { ?>
            <div class="social-links">
                <?php tfuse_footer_social(); ?>
            </div>
        <?php }

        echo $after_widget;
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title'=>'', 'hours' => '', 'adress' => '', 'phone' => '') );

        $instance['title'] = $new_instance['title'];
        $instance['hours'] = $new_instance['hours'];
        $instance['adress'] = $new_instance['adress'];
        $instance['phone'] = $new_instance['phone'];
        $instance['enable_social'] = isset($new_instance['enable_social']);
        return $instance;
    }

    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array( 'title'=>'', 'hours' => '','adress' => '', 'phone' => '', 'enable_social' => '') );
        $title = $instance['title'];
        ?>

    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','tfuse'); ?></label><br/>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('adress'); ?>"><?php _e('Address:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('adress'); ?>" name="<?php echo $this->get_field_name('adress'); ?>" type="text" value="<?php echo esc_attr($instance['adress']); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('hours'); ?>"><?php _e('Hours:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('hours'); ?>" name="<?php echo $this->get_field_name('hours'); ?>" type="text" value="<?php echo  esc_attr($instance['hours']); ?>"  />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone Number:','tfuse'); ?></label><br/>
        <input class="widefat " id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
    </p>
    <p>
        <input id="<?php echo $this->get_field_id('enable_social'); ?>" name="<?php echo $this->get_field_name('enable_social'); ?>" type="checkbox" <?php checked(isset($instance['enable_social']) ? $instance['enable_social'] : 0); ?> />&nbsp;
        <label for="<?php echo $this->get_field_id('enable_social'); ?>"><?php _e('Enable social buttons?','tfuse'); ?></label>
    </p>
    <?php
    }
}
register_widget('TFuse_Widget_Contact');