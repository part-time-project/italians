<?php
/**
 * Banner Slider
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_banner_slider($atts, $content) {
    global $slide;
    $slide = '';
    $i = 0;
    $uniq = rand(1, 400);
    extract(shortcode_atts(array('target' => '', 'title' => '', 'before_title' => ''), $atts));
    $get_banner_slider = do_shortcode($content);
    $output = '';
    $pagination = '<div class="post-navigation"><ol class="carousel-indicators">';

    $output .= '<section class="about-us-slider">
        <div class="divider"></div>
        <h2 class="before-title">'.$before_title.'</h2>
        <h1 class="title">'.$title.'</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 banner_container">
                    <div class="main-carousel">
                        <div id="myCarousel" class="carousel slide">
                            <div class="carousel-inner">';
                                while (isset($slide['image'][$i])) {
                                    $getimage = new TF_GET_IMAGE();
                                    $img = $getimage->width(750)->height(489)->src($slide['image'][$i])->get_img();
                                    if($i==0){
                                        $output .= '<div class="item active"><a target="'.$target.'" href="'.$slide['url'][$i].'">'.$img.'</a></div>';
                                        $pagination .= '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
                                    }
                                    else{
                                        $output .= '<div class="item"><a target="'.$target.'" href="'.$slide['url'][$i].'">'.$img.'</a></div>';
                                        $pagination .= '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
                                    }
                                    $i++;
                                }
                                $pagination .= '</ol></div>';
                            $output .= '</div>'.$pagination.'
                        </div>
                    </div>
                 </div>
             </div>
        </div>';
    $output .= "<script>
        jQuery(document).ready(function($) {
            var slider = $('#myCarousel'), animateClass;
            slider.carousel({
                interval: 7500,
                pause: 'none'
            });
            slider.find('[data-animate-in]').addClass('animated');
            function animateSlide() {
                slider.find('.item').removeClass('current');
                slider.find('.active').addClass('current').find('[data-animate-in]').each(function () {
                    var __this = $(this);
                    animateClass = __this.data('animate-in');
                    __this.addClass(animateClass)
                });
                slider.find('.active').find('[data-animate-out]').each(function () {
                    var __this = $(this);
                    animateClass = __this.data('animate-out');
                    __this.removeClass(animateClass)
                });
            }
            function animateSlideEnd() {
                slider.find('.active').find('[data-animate-in]').each(function () {
                    var __this = $(this);
                    animateClass = __this.data('animate-in');
                    __this.removeClass(animateClass)
                });
                slider.find('.active').find('[data-animate-out]').each(function () {
                    var __this = $(this);
                    animateClass = __this.data('animate-out');
                    __this.addClass(animateClass)
                });
            }
            slider.find('.invisible').removeClass('invisible');
                animateSlide();
                slider.on('slid.bs.carousel', function () {
                    animateSlide();
                });
                slider.on('slide.bs.carousel', function () {
                    animateSlideEnd();
                });
                if (Modernizr.touch) {
                    slider.find('.carousel-inner').swipe( {
                        swipeUp: function() {
                            $(this).parent().carousel('prev');
                        },
                        swipeDown: function() {
                            $(this).parent().carousel('next');
                        },
                        swipeLeft: function() {
                            $(this).parent().carousel('prev');
                        },
                        swipeRight: function() {
                            $(this).parent().carousel('next');
                        },
                        threshold: 30
                    })
                }
            });
    </script>";
    $output .= '</section>';

    return $output;
}

$atts = array(
    'name' => __('Banner Slider','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Target','tfuse'),
            'desc' => __('Specifies where to open the linked shortcode','tfuse'),
            'id' => 'tf_shc_banner_slider_target',
            'value' => '',
            'options' => array(
                '_self' => __('In the same frame as it was clicked','tfuse'),
                '_blank' => __('In a new window or tab','tfuse'),
                '_parent' => __('In the parent frame','tfuse'),
                '_top' => __('In the full body of the window','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_banner_slider_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Before Title','tfuse'),
            'desc' => __('Enter the before title','tfuse'),
            'id' => 'tf_shc_banner_slider_before_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Insert the sourse of image (750x490)','tfuse'),
            'id' => 'tf_shc_banner_slider_image',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('URL','tfuse'),
            'desc' => __('URL of the site for image','tfuse'),
            'id' => 'tf_shc_banner_slider_url',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'type' => 'text'
        )

    )
);

tf_add_shortcode('banner_slider', 'tfuse_banner_slider', $atts);


function tfuse_bslide($atts, $content = null)
{
    global $slide;
    extract(shortcode_atts(array('image' => '', 'url' => ''), $atts));
    $slide['image'][] = $image;
    $slide['url'][] = $url;
}

$atts = array(
    'name' => __('Slide','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 3,
    'options' => array(
        array(
            'name' => __('Image','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_bslide_image',
            'value' => 'image',
            'options' => array(
                'image' => __('Image','tfuse'),
                'text' => __('Text','tfuse')
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('URL','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_bslide_url',
            'value' => '',
            'type' => 'text'
        )
    )
);

add_shortcode('bslide', 'tfuse_bslide', $atts);