<?php
/**
 * The template for displaying content in the single-menu.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */
$permalink = get_permalink();
?>
<article class="post post-details portfolio-details">
    <header class="entry-header">
        <div class="entry-meta">
            <?php if(tfuse_options('enable_menus_meta', true)){ ?>
                <time class="entry-date"><?php echo get_the_date(); ?></time>
                <span class="author"> <?php _e('by','tfuse'); ?> <?php the_author_posts_link(); ?></span>
            <?php } ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <a href="#comments" class="link-comment">
                <span><?php comments_number('0','1','%'); ?></span>
            </a>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) { ?>
        <div class="menu-thumbnail">
            <?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' ); ?>
            <a title="<?php the_title(); ?>" rel="prettyPhoto" data-rel="prettyPhoto" href="<?php echo $src[0]; ?>"><?php the_post_thumbnail( '' ); ?></a>
        </div>
    <?php } ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
<?php get_template_part('content', 'author'); ?>

<!--Share Links-->
<section class="social-share-blog">
    <div class="twitter">
        <a href="https://twitter.com/share?url=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-twitter-postshare"></i><?php _e('Tweet','tfuse'); ?>
        </a>
    </div>
    <div class="facebook-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-facebook-postshare"></i><?php _e('Share','tfuse'); ?>
        </a>
    </div>
    <div class="pinterest">
        <a href="http://www.pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>" target="_blank">
            <i class="tficon-pinterest-postshare"></i><?php _e('Pin it','tfuse'); ?>
        </a>
    </div>
</section>

<section class="blog-post-navigation">
    <?php previous_post_link( '%link','<i class="tficon-shevron-left"></i><span>'.__('Previous Story','tfuse').'</span>%title' ); ?>
    <?php next_post_link( '%link', '<i class="tficon-shevron-right"></i><span>'.__('NEXT Story','tfuse').'</span>%title' ); ?>
</section>