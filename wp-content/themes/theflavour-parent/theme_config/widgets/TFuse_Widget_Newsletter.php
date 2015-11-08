<?php
// =============================== Newsletetr widget ======================================

class TFuse_newsletter extends WP_Widget {

    function TFuse_newsletter() {
        $widget_ops = array('description' => '');
        parent::__construct(false, __('TFuse - Newsletter', 'tfuse'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = esc_attr($instance['newsletter_title']);
        $before_title = esc_attr($instance['before_title']);
        $notice = esc_attr($instance['notice']);
        $rss = empty($instance['rss']) ? '' : esc_attr($instance['rss']);
        $before_widget = '<div class="widget widget_newsletter newsletter_subscription_box">';
        $after_widget = '</div>';

        echo $before_widget; ?>

        <?php if(!empty($before_title)){ ?>
            <h3 class="widget-title-before"><?php echo tfuse_qtranslate($before_title); ?></h3>
        <?php } ?>

        <?php if(!empty($title)){ ?>
            <h1 class="widget-title"><?php echo tfuse_qtranslate($title); ?></h1>
        <?php } ?>

        <?php if(!empty($notice)){ ?>
            <div class="widget-content"><p><?php echo tfuse_qtranslate($notice); ?></p></div>
        <?php } ?>

        <form action="#" method="post" class="newsletter_subscription_form">
            <input type="text" value="" name="newsletter" class="newsletter_subscription_email inputtext" placeholder="Enter Your Email" />
            <button type="submit" class="btn btn-newsletter newsletter_subscription_submit" value="<?php _e('Send', 'tfuse'); ?>" title="Subscribe"><span class="tficon-row"></span></button>
            <?php if ($rss != '') { ?>
                <div class="newsletter_text">
                    <a href="<?php echo tfuse_options('feedburner_url','#'); ?>" class="link-news-rss"><?php _e('Also subscribe to <span>our RSS feed</span>','tfuse'); ?></a>
                </div>
            <?php } ?>
        </form>

        <div class="newsletter_subscription_messages before-text" style="margin-left: 10px">
            <div class="newsletter_subscription_message_success">
                <?php _e('Thank you for your subscription.','tfuse') ?>
            </div>
            <div class="newsletter_subscription_message_wrong_email">
                <?php _e('Your email format is wrong!','tfuse') ?>
            </div>
            <div class="newsletter_subscription_message_failed">
                <?php _e('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') ?>
            </div>
        </div>
        <div class="newsletter_subscription_ajax" style="margin-left: 10px"><?php _e('Loading...','tfuse'); ?></div>
    <?php echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['newsletter_title'] = $new_instance['newsletter_title'];
        $instance['before_title'] = $new_instance['before_title'];
        $instance['notice'] = $new_instance['notice'];
        $instance['rss'] = isset($new_instance['rss']);
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('newsletter_title' => '', 'before_title' => '', 'notice' => '', 'rss' => ''));
        $newsletter_title = esc_attr($instance['newsletter_title']);
        $before_title = esc_attr($instance['before_title']);
        $notice = esc_attr($instance['notice']);
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('newsletter_title'); ?>"><?php _e('Title:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('newsletter_title'); ?>" value="<?php echo $newsletter_title; ?>" class="widefat" id="<?php echo $this->get_field_id('newsletter_title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('before_title'); ?>"><?php _e('Before Title:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('before_title'); ?>" value="<?php echo $before_title; ?>" class="widefat" id="<?php echo $this->get_field_id('before_title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('notice'); ?>"><?php _e('Notice:', 'tfuse'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('notice'); ?>" value="<?php echo $notice; ?>" class="widefat" id="<?php echo $this->get_field_id('notice'); ?>" />
        </p>
        <p>
            <input type="checkbox" <?php checked(isset($instance['rss']) ? $instance['rss'] : 0); ?> name="<?php echo $this->get_field_name('rss'); ?>" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" />
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Activate RSS', 'tfuse'); ?></label>
        </p>
    <?php
    }
}

register_widget('TFuse_newsletter');