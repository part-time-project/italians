<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
?>
<div id="main" class="site-main blog" role="main">
    <?php tfuse_show_blog_filter(); ?>
    <div <?php tfuse_class('middle');?> >
        <div class="row">
            <div class="col-xs-12 content-area col-sm-8" id="primary">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('listing', 'blog'); ?>
                    <?php endwhile; else: ?>
                    <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                <?php endif; ?>
                <?php tfuse_pagination(); ?>
            </div><!-- /#primary-->

            <?php if ($sidebar_position == 'left' || $sidebar_position == 'right') : ?>
                <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12 sidebar widget-area" id="secondary">
                    <div class="inner">
                        <?php get_sidebar(); ?>
                    </div><!--/ .inner -->
                </div><!--/ #secondary -->
            <?php endif; ?>

        </div><!-- /.row-->
    </div><!-- /.container-->
</div><!-- /#main-->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>