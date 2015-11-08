<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
    $ID = tfuse_return_term_id();
?>
<div id="main" class="site-main" role="main">
    <?php tfuse_custom_cat_title($ID, 'events'); ?>
    <div <?php tfuse_class('middle');?> >
        <div class="row">
            <div class="col-sm-12">
                <?php if (have_posts()) : ?>
                    <section class="events">
                        <div id="calendar"></div>
                    </section>
                <?php else: ?>
                    <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                <?php endif; ?>
            </div><!-- /.col-sm-12-->

        </div><!-- /.row-->
    </div><!-- /.container-->
</div><!-- /#main-->

<input type="hidden" value="<?php echo $ID; ?>" name="current_event" />
<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>