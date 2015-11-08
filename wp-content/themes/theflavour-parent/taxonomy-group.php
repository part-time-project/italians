<?php
    get_header();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
    wp_register_script( 'isotope', tfuse_get_file_uri('/js/isotope.pkgd.min.js'), array('jquery'), '1.0', true );
    wp_enqueue_script( 'isotope' );
    global $post;
    $columns = tfuse_get_portfolio_columns();
    $ID = tfuse_return_term_id();
?>
<div id="main" class="site-main blog" role="main">
    <?php tfuse_custom_cat_title($ID, 'events'); ?>
    <div <?php tfuse_class('middle');?> >
        <div class="row">
            <div class="col-sm-12">
                <section class="gallery">
                    <?php tfuse_show_gallery_filter(); ?>
                    <ul id="gallery-list" class="gallery-list <?php echo $columns; ?>">
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post(); ?>
                                <li class="gallery-item" data-category="<?php echo tfuse_get_portfolio_categories_list($post->ID); ?>">
                                    <div class="gallery-img">
                                        <?php echo tfuse_get_portfolio_thumbnail($post->ID, $columns); ?>
                                    </div>
                                    <?php echo tfuse_get_portfolio_gallery($post->ID); ?>
                                </li>
                            <?php endwhile; else: ?>
                            <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                        <?php endif; ?>
                    </ul>
                </section>
                <?php tfuse_pagination(); ?>
            </div><!-- /.col-sm-12-->
        </div><!-- /.row-->
    </div><!-- /.container-->
</div><!-- /#main-->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>