<?php
    /**
     * Template Name: SingleProffesional
     */
    global $wp_query, $is_tf_blog_page;
    get_header();
    if ($is_tf_blog_page) die();
    tfuse_shortcode_content('top');
?>
<div id="main" class="site-main blog-details" role="main">
    <?php tfuse_custom_title(); ?>
    <div <?php tfuse_class('middle'); ?>>
        <div class="row">
            <div class="col-xs-12 text-center content-area" id="primary">
                <div class="post-descr entry">
                    <?php while( have_posts() ) {
                        the_post();
                        the_content();
                        if( comments_open() ) tfuse_comments();
                    } ?>
                </div><!-- /.entry -->
            </div><!-- /#primary -->
        </div><!-- /.row -->
    </div><!--/ .container -->
</div><!--/ #middle -->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>