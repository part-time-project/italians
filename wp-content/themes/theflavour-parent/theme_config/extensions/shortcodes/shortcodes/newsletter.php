<?php
/**
 * Newsletter
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 * Optional arguments:
 * title: e.g. Newsletter signup
 * text: e.g. Thank you for your subscription.
 * action: URL where to send the form data.
 * rss_feed:
 */

function tfuse_newsletter($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '', 'text' => '', 'before_title' => ''), $atts));

    if (!empty($title))
        $title = '<h1 class="widget-title">'.$title.'</h1>';

    if (!empty($before_title))
        $before_title = '<h3 class="widget-title-before">'.$before_title.'</h3>';

    $out = '<div class="widget widget_newsletter newsletterBox newsletter_subscription_box">
        ' . tfuse_qtranslate($before_title) . '
        ' . tfuse_qtranslate($title) . '
        <div class="widget-content"><p>'.$text.'</p></div>
        <form action="#" method="post" class="newsletter_subscription_form">
            <input type="text" value="" name="newsletter" id="newsletter" class="newsletter_subscription_email inputField" placeholder="'.__('Enter Your Email','tfuse').'" />
            <button type="submit" class="btn btn-newsletter newsletter_subscription_submit" value="Send" title="Subscribe"><span class="tficon-row"></span></button>
            <div class="newsletter_subscription_ajax">'. __('Loading...','tfuse') .'</div>
        </form>
        <div class="newsletter_subscription_messages before-text">
            <div class="newsletter_subscription_message_success">
                '.__('Thank you for your subscription.','tfuse').'
            </div>
            <div class="newsletter_subscription_message_wrong_email">
                '.__('Your email format is wrong!','tfuse') .'
            </div>
            <div class="newsletter_subscription_message_failed">
                '. __('Sad, but we couldn\'t add you to our mailing list ATM.','tfuse') .'
            </div>
        </div>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Newsletter','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title of the Newsletter form','tfuse'),
            'id' => 'tf_shc_newsletter_title',
            'value' => 'Newsletter',
            'type' => 'text'
        ),
        array(
            'name' => __('Before Title','tfuse'),
            'desc' => __('Enter the before title of the Newsletter form','tfuse'),
            'id' => 'tf_shc_newsletter_before_title',
            'value' => 'Newsletter',
            'type' => 'text'
        ),
        array(
            'name' => __('Text','tfuse'),
            'desc' => __('Specify the newsletter message','tfuse'),
            'id' => 'tf_shc_newsletter_text',
            'value' => 'Want to get the latest news & promos?',
            'type' => 'textarea'
        ),
    )
);

tf_add_shortcode('newsletter', 'tfuse_newsletter', $atts);