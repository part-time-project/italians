<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
?>
<div id="main" class="site-main blog" role="main">
    <div <?php tfuse_class('middle'); ?>>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-offset-2 col-md-6" id="primary">
                <div class="inner">
                    <?php while ( have_posts() ) :
                        the_post();
                        get_template_part('content', 'single');
                        wp_link_pages();
                        if ( comments_open() ) tfuse_comments();
                    endwhile; // end of the loop. ?>
                </div><!-- /.inner -->
            </div><!-- /#primary -->
            
            <?php if ($sidebar_position == 'left' || $sidebar_position == 'right') : ?>
                <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12 sidebar widget-area" id="secondary">
                    <div class="inner">
                        <?php get_sidebar(); ?>
                    </div><!--/ .inner -->
                </div><!--/ #secondary -->
            <?php endif; ?>

        </div><!-- /.row -->
    </div><!-- /.container  -->
</div><!-- /#main -->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>