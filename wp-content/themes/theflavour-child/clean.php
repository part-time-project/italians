<?php
/**
 * Template Name: clean
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
                <div class="content-area" id="primary">
                    <div class="post-descr entry">
                        <div <?php tfuse_class('middle'); ?>>
                            <?php while (have_posts()) {
                                the_post();
                                the_content();
                                if (comments_open()) tfuse_comments();
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ #middle -->
    </div>


<?php tfuse_shortcode_content('bottom'); ?>
<?php get_footer(); ?>