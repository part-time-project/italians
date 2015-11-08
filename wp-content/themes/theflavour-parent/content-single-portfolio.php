<?php
/**
 * The template for displaying content in the single-portfolio.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since The Flavour 1.0
 */
$permalink = get_permalink();
$categories_list = wp_get_post_terms($post->ID, 'group');
$categories = '';
if(!empty($categories_list)){
    $count = 0;
    foreach($categories_list as $cat){
        $count++;
        $categories .= '<a href="'.get_term_link($cat->term_id, 'group').'" title="'.__('View all posts in','tfuse').' '.$cat->name.'" rel="category tag">'.$cat->name.'</a>';
        if(sizeof($categories_list) > $count) $categories .= ', ';
    }
}
?>
<article class="post post-details portfolio-details">
    <header class="entry-header">
        <div class="entry-meta">
            <?php if(tfuse_options('enable_porfolio_meta', true)){ ?>
                <time class="entry-date"><?php echo get_the_date(); ?></time>
                <span class="author"> <?php _e('by','tfuse'); ?> <?php the_author_posts_link(); ?></span>
                <span class="cat-links"> <?php _e('in','tfuse'); ?> <?php echo $categories; ?></span>
            <?php } ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php if ( comments_open() ){ ?>
                <a href="#comments" class="link-comment">
                    <span><?php comments_number('0','1','%'); ?></span>
                </a>
            <?php } ?>
        </div>
    </header>

    <?php echo tfuse_get_portfolio_singe_gallery($post->ID); ?>
    <div class="entry-content"><?php the_content(); ?></div>
</article>

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