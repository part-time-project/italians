<?php
/**
 * Testimonials
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 * Optional arguments:
 * title:
 * order: RAND, ASC, DESC
 */

function tfuse_testimonials($atts, $content = null) {
    global $testimonials_uniq;
    extract(shortcode_atts(array('title'=>'', 'order' => 'RAND', 'type' => 'big_slider', 'subtitle' => false), $atts));
    $slide = $nav = $single = '';
    $testimonials_uniq = rand(800, 900);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC'))
        $order = '&order=' . $order;
    else
        $order = '&orderby=rand';

    $posts = get_posts('post_type=testimonials&posts_per_page=-1' . $order);
    $k = 0;

    if($type == 'big_slider'){
        foreach($posts as $item){
            $k++;
            $slide .= '<li data-testimonial="1">
                <div class="testimonials-text"><p>'.$item->post_content.'</p></div>
                <div class="testimonials-author"><span>'.$item->post_title.'</span></div>';
                if( ($from = tfuse_page_options('testimonials_from','',$item->ID)) !='') $slide .= '<div class="testimonials-organization"><span>'.__('review from','tfuse').'</span> <a href="'.tfuse_page_options('testimonials_url','#',$item->ID).'">'.$from.'</a></div>';
            $slide .= '</li>';
        }

        if ($k > 1) {
            $nav = '<a id="testimonials-prev'.$testimonials_uniq.'" class="prev" href="#"><i class="tficon-shevron-left"></i></a>
            <a id="testimonials-next'.$testimonials_uniq.'" class="next" href="#"><i class="tficon-shevron-right"></i></a>';
        }
        else
            $single = ' style="display: block"';

        $output = '<section class="testimonials testimonials'.$testimonials_uniq.' '.$single.'">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h3 class="testimonials-title-before">'.$title.'</h3>
                        <h1 class="testimonials-title">'.$subtitle.'</h1>
                        <div class="testimonials-slider">
                            <span class="tficon-apostroufe"></span>
                            <ul id="testimonials'.$testimonials_uniq.'">
                                '.$slide.'
                            </ul>
                            <div id="testimonials-controls'.$testimonials_uniq.'" class="testimonials-controls"></div>
                        </div>
                    </div>
                    '.$nav.'
                </div>
            </div>
        </section>
        <script>
            jQuery(document).ready(function() {
                function testimonialsInit() {
                    jQuery("#testimonials'.$testimonials_uniq.'").carouFredSel({
                        swipe : {
                            onTouch: true
                        },
                        next : "#testimonials-next'.$testimonials_uniq.'",
                        prev : "#testimonials-prev'.$testimonials_uniq.'",
                        pagination : "#testimonials-controls'.$testimonials_uniq.'",
                        infinite: false,
                        items: 1,
                        auto: {
                            play: true,
                            timeoutDuration: 10000
                        },
                        scroll: {
                            items : 1,
                            fx: "crossfade",
                            easing: "linear",
                            pauseOnHover: true,
                            duration: 300
                        }
                    });
                }
                testimonialsInit();
                jQuery(window).resize(function() {
                    testimonialsInit();
                });
                var tControlsHeight = jQuery(".testimonials-controls").innerHeight();
                jQuery(".testimonials-controls").css("margin-top" , -tControlsHeight/2);
            });
        </script>';
    }
    else{
        $output = $class = '';
        if($type == 'mini_boxed') $class = 'quoteBox';

        foreach($posts as $item){
            $k++;
            $slide .= '<div class="slider-item '.$single.'">
                <div class="quote-text">'.$item->post_content.'</div>
                <div class="quote-author"><span>'.$item->post_title.'</div>
            </div>';
        }

        if ($k > 1) {
            $nav = '<a id="testimonials-prev'.$testimonials_uniq.'" class="prev" href="#"><i class="tficon-shevron-left"></i></a><a id="testimonials-next'.$testimonials_uniq.'" class="next" href="#"><i class="tficon-shevron-right"></i></a>';
        }
        else
            $single = ' style="display: block"';

        if($title != '') $output .= '<h2>'.$title.'</h2>';
        $output .= '<div class="slider slider_quotes '.$class.'">
            <div class="slider_container clearfix" id="testimonials'.$testimonials_uniq.'">
                '.$slide.'
            </div>
            '.$nav.'
        </div>
        <script>
            jQuery(document).ready(function() {
                jQuery("#testimonials'.$testimonials_uniq.'").carouFredSel({
                    next : "#testimonials-next'.$testimonials_uniq.'",
                    prev : "#testimonials-prev'.$testimonials_uniq.'",
                    responsive: true,
                    infinite: false,
                    items: 1,
                    auto: false,
                    scroll: {
                        items : 1,
                        fx: "crossfade",
                        easing: "linear",
                        duration: 300
                    }
                });
            });
        </script>';
    }

    return $output;
}

$atts = array(
    'name' => __('Testimonials','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_testimonials_title',
            'value' => 'Testimonials',
            'type' => 'text'
        ),
        array(
            'name' => __('Subtitle','tfuse'),
            'desc' => __('Specifies the subtitle of an shortcode','tfuse'),
            'id' => 'tf_shc_testimonials_subtitle',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Order','tfuse'),
            'desc' => __('Select display order','tfuse'),
            'id' => 'tf_shc_testimonials_order',
            'value' => 'DESC',
            'options' => array(
                'RAND' => __('Random','tfuse'),
                'ASC' => __('Ascending','tfuse'),
                'DESC' => __('Descending','tfuse')
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select type','tfuse'),
            'id' => 'tf_shc_testimonials_type',
            'value' => 'big_slider',
            'options' => array(
                'mini_slider' => __('Mini Slider','tfuse'),
                'mini_boxed' => __('Mini Slider Boxed','tfuse'),
                'big_slider' => __('Big Slider','tfuse'),
            ),
            'type' => 'select'
        ),
    )
);

tf_add_shortcode('testimonials', 'tfuse_testimonials', $atts);