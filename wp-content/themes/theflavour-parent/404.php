<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
?>
<div id="main" class="site-main blog-details" role="main">
    <div <?php tfuse_class('middle'); ?>>
        <div class="row">
            <div class="col-xs-12 content-area col-sm-8" id="primary">
                <div class="post-descr entry">
                    <div class="text-center">
                        <?php _e('404 - Page not found','tfuse'); ?>
                        <div class="text_404"><?php echo tfuse_options('text_404',''); ?></div>
                        <p><a href="javascript:history.go(-1)" class="btn btn-orange" hidefocus="true" style="outline: none;"><span><?php _e('GO BACK TO PREVIOUS PAGE','tfuse'); ?></span></a></p>
                    </div>
                </div><!-- /.entry -->
            </div><!-- /#primary -->

            <?php if ($sidebar_position == 'left' || $sidebar_position == 'right') : ?>
                <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12 sidebar widget-area" id="secondary">
                    <div class="inner">
                        <?php get_sidebar(); ?>
                    </div><!--/ .inner -->
                </div><!--/ #secondary -->
            <?php endif; ?>

        </div><!-- /.row -->
    </div><!--/ .container -->
</div><!--/ #middle -->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>