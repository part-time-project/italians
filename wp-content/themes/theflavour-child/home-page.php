<?php
    /**
     * Template Name: HomePage
     */
    global $wp_query, $is_tf_blog_page;
    get_header();
    if ($is_tf_blog_page) die();
    $sidebar_position = tfuse_sidebar_position();
    tfuse_shortcode_content('top');
?>
<div id="main" class="site-main blog-details" role="main">
    <?php tfuse_custom_title(); ?>
    <div <?php tfuse_class('middle'); ?>>
        <div class="row">

        </div><!-- /.row -->
    </div><!--/ .container -->
</div><!--/ #middle -->

<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>