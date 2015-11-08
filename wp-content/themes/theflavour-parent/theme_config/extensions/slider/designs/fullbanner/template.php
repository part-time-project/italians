<?php $id = rand(1, 100); ?>
<div class="main-top">
    <div class="slider-full">
        <!-- Loading Spinner -->
        <div class="spinner">
            <div class="wBall" id="wBall_1">
                <div class="wInnerBall">
                </div>
            </div>
            <div class="wBall" id="wBall_2">
                <div class="wInnerBall">
                </div>
            </div>
            <div class="wBall" id="wBall_3">
                <div class="wInnerBall">
                </div>
            </div>
            <div class="wBall" id="wBall_4">
                <div class="wInnerBall">
                </div>
            </div>
            <div class="wBall" id="wBall_5">
                <div class="wInnerBall">
                </div>
            </div>
        </div>
        <!--/ Loading Spinner -->

        <div class="main-carousel invisible">
            <div id="myCarousel<?php echo $id; ?>" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $count = 0;
                    $pagination = '';
                    foreach($view_variables['slides'] as $slide){
                        if($count==0) {
                            $class = 'active';
                            $first_image = $slide['slide_src'];
                        }
                        else $class = '';

                        $position_span = strpos($slide['slide_title'], '</span>');
                        $span_title = '';
                        if($position_span){
                            $position_span = $position_span+7;
                            $span_title = substr($slide['slide_title'], 0, $position_span);
                            $title = substr($slide['slide_title'], $position_span);
                        }
                        else{
                            $title = $slide['slide_title'];
                        }
                    ?>
                    <div class="item <?php echo $class; ?>" style="background-image:url(<?php echo $slide['slide_src']; ?>);">
                        <div class="title-wrap">
                            <div data-animate-in="fadeInDown" data-animate-out="fadeOutUp" class="invisible">
                                <?php if($span_title!=''){ ?>
                                    <div class="slider-title-before">
                                        <div class="title-line left"></div>
                                        <?php echo $span_title; ?>
                                        <div class="title-line right"></div>
                                    </div>
                                <?php } ?>
                                <h1 class="slider-title"><?php echo $title; ?></h1>
                                <h5 class="slider-subtitle"><?php echo $slide['slide_subtitle']; ?></h5>
                            </div>
                            <div data-animate-in="fadeInUp" data-animate-out="fadeOutDown" class="invisible"><a href="<?php echo $slide['slide_url']; ?>" class="btn slider-btn anchor-scroll"><span><?php echo $slide['slide_btn_text']; ?></span></a>
                            </div>
                        </div>
                    </div>
                    <?php
                        $pagination .= '<li data-target="#myCarousel'.$id.'" data-slide-to="'.$count.'" class="'.$class.'"></li>';
                        $count++;
                    } ?>

                </div>
                <!--Slider Navigation-->
                <div class="post-navigation">
                    <ol class="carousel-indicators">
                        <?php echo $pagination; ?>
                    </ol>
                    <a class="carousel-control left" href="#myCarousel<?php echo $id; ?>" data-slide="prev"><i class="tficon-shevron-left"></i></a>
                    <a class="carousel-control right" href="#myCarousel<?php echo $id;?>" data-slide="next"><i class="tficon-shevron-right"></i></a>
                </div>
                <!--/Slider Navigation-->
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
        $('.main-carousel').prepend('<img src="<?php echo $first_image; ?>" alt="" class="testimage hidden">');
        $('.testimage').load(function(){
            $(".main-top .spinner, .main-top .testimage").remove();
            $(".main-carousel").removeClass('invisible').addClass('animated fadeIn');
        });
        var slider = $('#myCarousel<?php echo $id; ?>'),
            animateClass;
        slider.carousel({
            interval: <?php if(isset($view_variables['general']['slider_interval'])) echo $view_variables['general']['slider_interval']; else echo '7500';?>,
            pause: 'none'
        });
        slider.find('[data-animate-in]').addClass('animated');
        function animateSlide() {
            slider.find('.item').removeClass('current');
            slider.find('.active').addClass('current').find('[data-animate-in]').each(function () {
                var $this = $(this);
                animateClass = $this.data('animate-in');
                $this.addClass(animateClass)
            });
            slider.find('.active').find('[data-animate-out]').each(function () {
                var $this = $(this);
                animateClass = $this.data('animate-out');
                $this.removeClass(animateClass)
            });
        }
        function animateSlideEnd() {
            slider.find('.active').find('[data-animate-in]').each(function () {
                var $this = $(this);
                animateClass = $this.data('animate-in');
                $this.removeClass(animateClass)
            });
            slider.find('.active').find('[data-animate-out]').each(function () {
                var $this = $(this);
                animateClass = $this.data('animate-out');
                $this.addClass(animateClass)
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
    });
</script>